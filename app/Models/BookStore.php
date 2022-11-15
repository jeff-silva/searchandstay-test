<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookStore extends Model
{
    use HasFactory, \App\Traits\Model;

    protected $table = 'book_store';
    protected $fillable = ['id', 'name', 'isbn', 'value'];

    public function validationRules()
    {
        return [
            'name' => ['required'],
            'isbn' => ['required', 'unique:book_store,isbn'],
            'value' => ['required'],
        ];
    }

    public function validationMessages()
    {
        return [
            'name.required' => 'Book name is required',
            'isbn.required' => 'ISBN number is required',
            'isbn.unique' => 'ISBN has already been taken',
            'value.required' => 'Book price is required',
        ];
    }

    public function onSearch($query, $params)
    {
        if ($params->name) {
            $query->where('name', 'like', "%{$params->name}%");
        }

        return $query;
    }
}
