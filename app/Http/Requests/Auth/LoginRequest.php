<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * Request class for handling login validation.
 */
class LoginRequest extends FormRequest {

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool {
    return TRUE;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, string>
   */
  public function rules(): array {
    return [
      'email' => 'required|string|email|max:255',
      'password' => 'required|string|min:8',
    ];
  }

  /**
   * Attempt to authenticate the request's credentials.
   *
   * @return void
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  public function authenticate(): void {
    $credentials = $this->only('email', 'password');

    if (!Auth::attempt($credentials, $this->boolean('remember'))) {
      throw ValidationException::withMessages([
        'email' => __('auth.failed'),
      ]);
    }
  }

}
