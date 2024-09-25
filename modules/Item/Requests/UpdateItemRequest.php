<?php

namespace Modules\Item\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'deadline' => 'nullable|date',
            'completed' => 'nullable|boolean',
            'status' => 'nullable|string|in:draft,pending,in_progress,done',
        ];
    }
}
