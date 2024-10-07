<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request class for handling profile update validation.
 */
class ProfileUpdateRequest extends FormRequest {

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
    $user = $this->user();

    if ($user === NULL) {
      throw new \RuntimeException('User must be authenticated to update profile.');
    }

    return [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
      'profile_picture' => 'nullable|image|max:2048',
    ];
  }

}
