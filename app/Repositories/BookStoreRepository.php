<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\RepositoryInterface;
use App\Models\BookStore;
use App\Exceptions\Error;

class BookStoreRepository implements RepositoryInterface
{
  public function validate(Request $request)
  {
    return (new BookStore)->validate($request);
  }


  public function index(Request $request)
  {
    return BookStore::query()
      ->search($request->all())
      ->with(['categories'])
      ->simplePaginate(request('per_page', 10));
  }

  public function store(Request $request)
  {
    $model = BookStore::create($request->all());
    $model->categories()->sync($request->input('category_ids', []));
    $model->category_ids = $model->categories()->allRelatedIds();
    return $model;
  }

  public function show($id)
  {
    $model = BookStore::find($id);
    if (! $model) {
      throw new \App\Exceptions\Error(404, 'Book not found');
    }
    $model->category_ids = $model->categories()->allRelatedIds();
    return $model;
  }

  public function update(Request $request, $id)
  {
    $model = BookStore::find($id);
    if (! $model) throw new Error(404, 'Book not found');
    $model->fill($request->all());
    $model->save();
    $model->categories()->sync($request->input('category_ids', []));
    $model->category_ids = $model->categories()->allRelatedIds();
    return $model;
  }

  public function destroy($id)
  {
    $model = BookStore::find($id);
    if (! $model) throw new Error(404, 'Book not found');
    $model->delete();
    return $model;
  }
}
