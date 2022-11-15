<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookStore extends Model
{
    use HasFactory, \App\Traits\Model;

    protected $table = 'book_store';
    protected $fillable = ['id', 'name', 'isbn', 'value'];

    public function onSearch($query, $params)
    {
        if ($params->name) {
            $query->where('name', 'like', "%{$params->name}%");
        }

        return $query;
    }
}
