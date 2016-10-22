<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'fee_id' => 'required',
            'service_name' => 'required',
            'payment_amount' => 'required',
            'paid_amount' => 'required',
            'payment_mode' => 'required',
            'paymentdate' => 'required',
        ];
    }
}
