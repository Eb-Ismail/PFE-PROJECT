<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationRequest extends FormRequest
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
        return [
            'titre'=>'required|min:5,max:150',
            'body'=>'required|min:20',
            'image'=>'image|mimes:png,jpg,jpeg,svg|max:10240',
        ];
    }

    public function messages(){
        return [
        //    'titre.required' => "Le titre est obligatoire Ismail",
        ];
    }
}
