<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $adminRoleId = Role::query()->where('name',__('roles.admin'))->first()->id;
        return [
            'name' => ['required','string'],
            'email' => ['required', 'unique:users,email,' . optional($this->user)->id],
            'password' => [Rule::requiredIf($this->isMethod('POST')), Rule::when($this->isMethod('PUT'), ['nullable']), 'min:6' ,'confirmed'],
            'role_id' => ['required','exists:roles,id', Rule::notIn([$adminRoleId])]
        ];
    }
}
