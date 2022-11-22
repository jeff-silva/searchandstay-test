<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\BookStoreInterface;
use App\Models\BookStore;

class BookStoreRepository implements BookStoreInterface
{
  public function search(Request $request)
  {
    return BookStore::query()
      ->search($request->all())
      ->simplePaginate(request('per_page', 10));
  }

  public function store(Request $request)
  {
    return BookStore::create($request->all());
  }

  public function show($id)
  {
    $model = BookStore::find($id);
    if (! $model) {
      throw new \App\Exceptions\ApiException(404, 'Book not found');
    }
    return $model;
  }

  public function update(Request $request, $id)
  {
    $model = BookStore::firstOrNew(['id' => $id]);
    $model->fill($request->all());
    $model->save();
    return $model;
  }

  public function destroy($id)
  {
    $model = BookStore::find($id);
    if (! $model) {
      throw new \App\Exceptions\ApiException(404, 'Book not found');
    }
    $model->delete();
    return $model;
  }
}
