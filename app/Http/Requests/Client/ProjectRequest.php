<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //by default return false, so to use the request make the function return true
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required','string'],
            'type' => ['required','in:hourly,fixed'],
            'budget' => ['nullable','numeric','min:0']
        ];
    }
    //this function is optional, use it if u want to change of validation messages
    public function messages()
    {
        return [
            'title.required' => 'title is required'
        ];
    }
}
