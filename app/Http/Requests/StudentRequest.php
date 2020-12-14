<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        return [
            "student_type"         => 'required',
            "full_name"            => 'required|min:3|max:100',
            "father_name"          => 'required|min:3|max:100',
            "gender"               => 'required',
            "city"                 => 'required',
            "teacher_name"         => 'required',
            "class_name"           => 'required',
            "dob"                  => 'required',
            "student_id"           => 'required',
            "personal_statement"   => 'required',
            "status"               => 'required',
            "profile_picture"      => 'required',
        ];
    }
}
