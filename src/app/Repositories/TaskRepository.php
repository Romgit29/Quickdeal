<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class TaskRepository {
    public static function get(array $data): Collection {
        $result = Task::latest()
        ->with('author');
        if(array_key_exists('user_name', $data) || array_key_exists('author_id', $data)) {
            if(array_key_exists('author_id', $data)) $result->where('author_id', $data['author_id']);
            if(array_key_exists('user_name', $data)) {
                $result->whereHas('author', function($query) use ($data) {
                    $query->where('users.name', 'ilike', '%' . $data['user_name'] . '%');
                });
            }
        } else {
            $result->where('author_id', Auth::id());
        }
        if(array_key_exists('date_from', $data)) $result->whereDate('created_at', '>=', date($data['date_from']));
        if(array_key_exists('date_to', $data)) $result->whereDate('created_at', '<=', date($data['date_to']));
        if(array_key_exists('task_status_ids', $data)) $result->whereIn('task_status_id', $data['task_status_ids']);
        if(array_key_exists('name', $data) || array_key_exists('description', $data) || array_key_exists('user_name', $data)) {
            $result->where(function($query) use ($data) {
                if(array_key_exists('name', $data)) $query->orWhere('name', 'ilike', '%' . $data['name'] . '%');
                if(array_key_exists('description', $data)) $query->orWhere('description', 'ilike', '%' . $data['description'] . '%');
            });
        }
        
        return $result->get();
    }
}