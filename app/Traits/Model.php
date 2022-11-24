<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Exceptions\Error;

trait Model
{
  public static function bootModel()
  {
    static::saving(function($model) {
      $model->validate();
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

  public function validate($request = null)
  {

    /**
     * If data is null, validate with loaded data inside model:
     * Model::find(1)->validate()
     */
    if (null === $request) {
      $request = new Request($this->toArray());
    }

    /**
     * You can validate using pure array data
     * $model->validate(['name' => ''])
     */
    if (is_array($request)) {
      $request = new Request($request);
    }

    $rules = $this->validationRules($request);
    $messages = $this->validationMessages($request);
    $validator = \Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
      throw new Error(400, 'Validation errors', $validator->errors());
    }
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
