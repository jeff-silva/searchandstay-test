<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\RepositoryInterface;
use App\Models\BookCategory;

class BookCategoryRepository implements RepositoryInterface
{
  public function search(Request $request)
  {
    return BookCategory::query()
      ->search($request->all())
      ->simplePaginate(request('per_page', 10));
  }

  public function store(Request $request)
  {
    return BookCategory::create($request->all());
  }

  public function show($id)
  {
    $model = BookCategory::find($id);
    if (! $model) {
      throw new \App\Exceptions\ApiException(404, 'Book not found');
    }
    return $model;
  }

  public function update(Request $request, $id)
  {
    $model = BookCategory::firstOrNew(['id' => $id]);
    $model->fill($request->all());
    $model->save();
    return $model;
  }

  public function destroy($id)
  {
    $model = BookCategory::find($id);
    if (! $model) {
      throw new \App\Exceptions\ApiException(404, 'Book not found');
    }
    $model->delete();
    return $model;
  }
}
