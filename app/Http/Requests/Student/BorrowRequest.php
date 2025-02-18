<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BorrowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_id' => [
                'required',
                'exists:books,id',
                Rule::exists('books', 'id')->where('status', 'returned') // Cek apakah status "returned"
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'book_id.exists' => 'Buku ini sedang dipinjam dan belum tersedia untuk dipinjam kembali.'
        ];
    }
}
