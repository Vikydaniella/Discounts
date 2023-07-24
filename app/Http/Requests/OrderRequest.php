<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'customer_id'=> 'required|integer|max:30',
            'items'=>'required|array|max:1000',
            'total'=> 'required|float|max:1,000,000'
        ];
    }
}
