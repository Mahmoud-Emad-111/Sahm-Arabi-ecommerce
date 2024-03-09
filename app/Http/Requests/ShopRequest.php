<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'phone_number'=> 'required|max:12|unique:shops,phone_number',
            'whatsapp_number'=>'required|max:12|unique:shops,whatsapp_number',
            'urlStore'=>'required',
            'email'=>'required|email|unique:shops,email',
            'password' => 'required|string|min:8',
            'workingScops'=>'required', //pendingg
            'description'=>'required',
            'imageCard_one'=>'required|image',
            'imageCard_two'=>'required|image',
        ];
    }
}
