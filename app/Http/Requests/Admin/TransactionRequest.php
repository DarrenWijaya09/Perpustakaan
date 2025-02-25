<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
        //     'user_id' => 'required|exists:users,id',
        //     'book_id' => 'required|exists:books,id',
        //     'borrow_date' => 'required|date',
        //     'return_date' => 'nullable|date|after_or_equal:borrow_date',
        //     'status' => 'required|in:borrowed,returned'
        // ];

        $rules = [
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'nullable|date|after_or_equal:borrow_date',
            'status' => 'required|in:borrowed,returned'
        ];

        if ($this->isMethod('post')) {
            $rules['user_id'] = 'required|exists:users,id'; // Hanya validasi saat create
        }

        return $rules;
    }
}
