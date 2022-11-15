<?php

namespace App\Traits;

trait Model
{

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

  public function validate($data = [])
  {
    $rules = $this->validationRules();
    $messages = $this->validationMessages();
    return \Validator::make($data, $rules, $messages);
  }

  public function scopeSearch($query, $params = [])
  {
    return $query;
  }
}
