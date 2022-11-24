<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class BookCategory extends Model
{
    use HasFactory, \App\Traits\Model;

    protected $table = 'book_category';
    protected $fillable = ['id', 'name'];


    public function validationRules($request)
    {
        return [
            'name' => ['required'],
        ];
    }


    public function validationMessages($request)
    {
        return [
            'name.required' => 'Book category is required',
        ];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }

    public function onSearch($query, $params)
    {
        if ($params->term) {
            $query->where('name', 'like', "%{$params->term}%");
        }

        return $query;
    }
}
