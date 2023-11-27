<?php
/**
 * @copyright (c) 2023 ${PROJECT_NAME}
 * @author        Dr. Manuel Lamotte-Schubert, pronego (https://www.pronego.com)
 * @date          2023-11-21 07:35
 */

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UserEditRequest extends FormRequest {

	use PasswordValidationRules;

	public function rules(): array
	{
		$rules = [
			'username' => 'required|string|max:255',
			'email' => 'required|string|email|max:255',
			'firstname' => 'nullable|string|max:255',
			'lastname' => 'nullable|string|max:255',
			'active' => 'boolean',
		];

		// Add password rules if password or confirmation was filled
		if ($this->request->get('password') || $this->request->get('password_confirmation'))
		{
			$rules['password'] = ['required', 'confirmed', $this->passwordRules()];
		}

		return $rules;
	}

	public function authorize(): bool
	{
		// $this->>user() is the logged-in user
		// $this->>route('user') accesses the bound entity in the form request; alternatively $this->user
		return $this->user()->can('edit', $this->user);
	}
}
