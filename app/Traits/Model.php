<?php

namespace App\Traits;

use Illuminate\Http\Request;

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


  // Search methods
  public function onSearch($query, $params)
  {
    return $query;
  }

  public function scopeSearch($query, $params = [])
  {
    return $this->onSearch($query, new Request($params));
  }
}
