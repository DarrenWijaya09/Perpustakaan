<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberRequest;
use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('user')
            ->when(request('search'), function ($query) {
                return $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        $users = User::whereIn('role', ['admin', 'student'])
            ->whereDoesntHave('member') // Hanya user yang belum menjadi anggota
            ->select('id', 'name', 'email', 'nis', 'class', 'major')
            ->get();

        return view('admin.members.create', compact('users'));
    }

    public function store(MemberRequest $request)
    {
        Member::create($request->validated());

        return redirect()->route('admin.members.index')->with('success', 'Anggota berhasil ditambahkan!');
    }

    public function edit(Member $member)
    {
        $users = User::whereIn('role', ['admin', 'student'])
            ->select('id', 'name', 'email', 'nis', 'class', 'major')
            ->get();

        return view('admin.members.create', compact('member', 'users'));
    }

    public function update(MemberRequest $request, Member $member)
    {
        $validatedData = $request->validated();

        // Pastikan user_id dan nis tetap menggunakan nilai lama
        $validatedData['user_id'] = $member->user_id;
        $validatedData['nis'] = $member->nis;

        $member->update([
            'class' => $validatedData['class'],
            'major' => $validatedData['major'],
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Data anggota berhasil diperbarui!');
    }


    public function destroy(Member $member)
    {
        $member->delete();
        return back()->with('success', 'Anggota berhasil dihapus!');
    }
}
