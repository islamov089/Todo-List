<?php

namespace Modules\Item\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
{
  
    public function authorize()
    {
        return true;
    }

   
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'deadline' => 'required|date',
        ];
    }
}
