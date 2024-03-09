<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreditshopRequest extends FormRequest
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
            'name'=> 'required',
            'number_card'=>'required|min:16|max:16',
            'ccv'=> 'required|min:3|max:3',
            'date' => 'required',
            'shop_id' => 'required|exists:shops,id', 
        ];
    }
}
