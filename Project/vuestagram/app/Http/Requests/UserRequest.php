<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
	// /**
	//  * Determine if the user is authorized to make this request.
	//  *
	//  * @return bool
	//  */
	// public function authorize()
	// {
	//     return false;
	// }

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		$rules = [
			'account' =>['required', 'between:5,20', 'regex:/^[0-9a-zA-Z]+$/']
			,'password' =>['required', 'between:5,20', 'regex:/^[0-9a-zA-Z!@]+$/']
		];

		if($this->routeIs('post.login')){
			$rules['account'][] = 'exists:users,account';
		}

		return $rules;
	}

	protected function failedValidation(ValidationValidator $validator)
	{
		$request = response()->json([
			'success' => false
			,'message' => '유효성 체크 오류'
			,'data' => $validator->errors()
		], 422);

		throw new HttpResponseException($request);
	}
}
