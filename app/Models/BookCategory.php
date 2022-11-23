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


    public function validationRules()
    {
        return [
            'name' => ['required'],
        ];
    }


    public function validationMessages()
    {
        return [
            'name.required' => 'Book name is required',
        ];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords(strtolower($value));
    }
}
