<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use App\Models\BookCategory;

class BookStore extends Model
{
    use HasFactory, \App\Traits\Model;

    protected $table = 'book_store';
    protected $fillable = ['id', 'name', 'isbn', 'value'];


    public function validationRules($request)
    {
        return [
            'name' => ['required'],
            'isbn' => ['required', Rule::unique('book_store', 'isbn')->ignore($request->id)],
            'value' => ['required'],
        ];
    }


    public function validationMessages($request)
    {
        return [
            'name.required' => 'Book name is required',
            'isbn.required' => 'ISBN number is required',
            'isbn.unique' => 'ISBN has already been taken',
            'value.required' => 'Book price is required',
        ];
    }


    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }
    

    public function setIsbnAttribute($value)
    {
        $this->attributes['isbn'] = preg_replace('/[^0-9]/', '', $value);
    }


    public function onSearch($query, $params)
    {
        if ($params->term) {
            $query->where(function($query) use($params) {
                $query->where('name', 'like', "%{$params->term}%");
                $query->orWhere('isbn', 'like', "%{$params->term}%");
            });
        }

        if ($params->value_min) {
            $query->where('value', '>=', $params->value_min);
        }
        
        if ($params->value_max) {
            $query->where('value', '<=', $params->value_max);
        }

        return $query;
    }

    public function categories()
    {
        return $this->belongsToMany(BookCategory::class, 'book_store_category', 'book_store_id', 'book_category_id');
    }
}
