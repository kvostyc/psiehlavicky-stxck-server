<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'order_number' => 'required|string|unique:orders,order_number|max:12',
            'customer_email' => 'nullable|email|max:255',
            'customer_fullname' => 'nullable|string|max:255',
            'total_cost' => 'nullable|numeric|min:0',
            'discount_amout' => 'nullable|numeric|min:0',
            'shipping' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:1000',
            'status' => 'nullable|string|max:255',
        ];
    }
}
