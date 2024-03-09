<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletshopRequest extends FormRequest
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
            'company'=> 'required',
            'phone_number' =>'required|max:12',
            'shop_id' => 'required|exists:shops,random_id',
        ];
    }
}
