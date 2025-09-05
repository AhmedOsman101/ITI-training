<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array {
    $studentId = $this->route('student')->id;

    return [
      'name'          => ['required', 'string', 'max:255'],
      'email'         => [
        'required',
        'email',
        Rule::unique('students', 'email')->ignore($studentId),
      ],
      'department_id' => ['required', 'exists:departments,id'],
      'image'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'], // 2MB max size
    ];
  }

  /**
   * Custom error messages (optional).
   */
  public function messages(): array {
    return [
      'name.required'          => 'Student name is required.',
      'email.required'         => 'Student email is required.',
      'email.unique'           => 'This email is already taken.',
      'department_id.required' => 'The department is required',
      'image.max'              => 'Image too big, maximum allowed 2MB',
    ];
  }
}
