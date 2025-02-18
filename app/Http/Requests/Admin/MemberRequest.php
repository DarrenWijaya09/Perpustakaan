<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // return [
        //     'user_id' => 'required|exists:users,id|unique:members,user_id',
        //     'nis' => 'required|string|unique:members,nis|max:50',
        //     'class' => 'required|string|max:50',
        //     'major' => 'required|string|max:100',
        // ];

        $memberId = $this->route('member') ? $this->route('member')->id : null;

    return [
        'user_id' => 'required|exists:users,id' . ($this->isMethod('post') ? '|unique:members,user_id' : ''),
        'nis' => 'required|string|max:50' . ($memberId ? "|unique:members,nis,$memberId" : '|unique:members,nis'),
        'class' => 'required|string|max:50',
        'major' => 'required|string|max:100',
    ];
    }
}
