<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    
    public function authorize()
    {
        return false;
    }
    public function rules()
    {
        return [
            'id'=> 'required|string|max:4',
            'description'=>'required|string|max:20',
            'category'=> 'required|integer|max:2',
            'price'=>'required|float|max:1,000,000'
        ];
    }
}
