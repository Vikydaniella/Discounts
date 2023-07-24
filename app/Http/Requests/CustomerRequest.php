<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        return false;
    }
    public function rules()
    {
        return [
            'name'=> 'required|string|max:30',
            'since'=>'required|date|max:20',
            'revenue'=> 'required|decimal|max:1,000,000'
        ];
    }
}
