<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequest extends FormRequest
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
            "payment_type"                      => 'required',
            "date_of_donation"                  => 'required',
            "first_name"                        => 'required',
            "last_name"                         => 'required',
            "gift_aid"                          => 'required',
            "city"                              => 'required',
            "country"                           => 'required',
            "postal_code"                       => 'required',
            "contact"                           => 'required',
            "email"                             => 'required',
            "address_line1"                     => 'required',
            "address_line2"                     => 'required',
            'donationsArray.*.project'          => 'required',
            'donationsArray.*.donation_type'    => 'required',
            'donationsArray.*.amount'           => 'required',
        ];
    }

    public function messages()
    {
        return [
            'donationsArray.*.project.required'          => 'Donation Project is Required',
            'donationsArray.*.donation_type.required'    => 'Donation Type is Required',
            'donationsArray.*.amount.required'           => 'Donation Amount  is Required',
        ];
    }
}
