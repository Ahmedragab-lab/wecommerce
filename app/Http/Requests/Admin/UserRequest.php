<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name'      => 'required',
                    'email'         => 'required|email|max:255|unique:users',
                    'phone'         => 'required|numeric|unique:users',
                    'status'        => 'required',
                    'password'      => 'required|min:6|confirmed',
                    'image' => 'nullable',
                    // 'image'         => 'nullable|mimes:jpg,jpeg,png,svg|max:20000'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name'      => 'required',
                    'email'         => 'required|email|max:255|unique:users,email,'.$this->route()->user->id,
                    'phone'         => 'required|numeric|unique:users,phone,'.$this->route()->user->id,
                    'status'        => 'required',
                    'password'      => 'nullable|min:6|confirmed',
                    'image' => 'nullable',
                    // 'image'         => 'nullable|mimes:jpg,jpeg,png,svg|max:20000'
                ];
            }
            default: break;
        }
    }
}
