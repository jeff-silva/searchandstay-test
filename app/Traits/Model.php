<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Model
{
  public static function bootModel()
  {
    static::saving(function($model) {
      $validate = $model->validate();

      if ($validate->fails()) {
        throw new \App\Exceptions\Error(500, 'Validation errors', $validate->errors());
      }
    });
  }

  public function validationRules()
  {
    return [
      'name' => ['required'],
    ];
  }
  
  public function validationMessages()
  {
    return [];
  }

  public function validate()
  {
    $rules = $this->validationRules();
    $messages = $this->validationMessages();
    $data = $this->toArray();
    return \Validator::make($data, $rules, $messages);
  }


  // Search methods
  public function onSearch($query, $params)
  {
    return $query;
  }

  public function scopeSearch($query, $params = [])
  {
    $params = is_array($params)? new Request($params): $params;
    return $this->onSearch($query, $params);
  }
}
