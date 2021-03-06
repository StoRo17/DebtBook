<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DebtsHistoryRequest extends FormRequest
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
            'amount' => 'required|digits_between:0,1000000',
            'type' => 'required|string|size:4',
            'comment' => 'string|nullable',
        ];
    }
}
