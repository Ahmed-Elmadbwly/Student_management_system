<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class student extends FormRequest
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
        $userId = $this->route('id');
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', $userId ? Rule::unique(User::class)->ignore($userId):'unique:'.User::class],
            'password' => [ $userId ? 'nullable' : 'required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'numeric', 'digits:11',$userId ?Rule::unique(User::class)->ignore($userId):'unique:'.User::class],
            'image' => [ $userId ? 'nullable' : 'required', 'image', 'mimes:jpeg,jpg,png'],
        ];
    }
}
