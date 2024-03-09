<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FactoryRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'logo'=>'required|image',
            'country'=>'required',
            'governorate'=>'required',
            'region' => 'required',
            'address'=>'required',
            'phone_number'=> 'required|max:12|unique:factories,phone_number',
            'whatsapp_number'=>'required|max:12|unique:factories,whatsapp_number',
            'urlStore'=>'required',
            'email'=>'required|email|unique:factories,email',
            'password' => 'required|string|min:8',
            'workingScops'=>'required',
            'description'=>'required',
            'sub_description'=>'required',
            'imageCard_one'=>'required|image',
            'imageCard_two'=>'required|image',
        ];
    }
}

