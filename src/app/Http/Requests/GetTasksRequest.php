<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GetTasksRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'date_from' => 'date:Y-m-d',
            'date_to' => 'date:Y-m-d',
            'status_type_ids' => 'array',
            'task_status_ids.*' => 'exists:task_statuses,id',
            'name' => 'string',
            'description' => 'string'
        ];
        if(Auth::user()->hasRole('admin')) {
            $rules['author_id'] = 'exists:users,id';
            $rules['user_name'] = 'string';
        }

        return $rules;
    }
}
