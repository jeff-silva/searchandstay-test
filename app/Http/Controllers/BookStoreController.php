<?php

namespace App\Http\Controllers;

use App\Models\BookStore;
use Illuminate\Http\Request;

class BookStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of books.
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/api/book-store",
     *      summary="",
     *      operationId="book-store.index",
     *      tags={"book-store"},
     *      @OA\Response(response=200, description="")
     * )
     */
    public function index(Request $request)
    {
        return BookStore::query()
            ->search($request->all())
            ->simplePaginate(request('per_page', 10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/book-store",
     *      summary="",
     *      operationId="book-store.store",
     *      tags={"book-store"},
     *      @OA\Response(response=200, description="")
     * )
     */
    public function store(Request $request)
    {
        return BookStore::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookStore  $bookStore
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/api/book-store/{book_store}",
     *      summary="",
     *      operationId="book-store.show",
     *      tags={"book-store"},
     *      @OA\Response(response=200, description="")
     * )
     */
    public function show(BookStore $model)
    {
        return $model;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookStore  $bookStore
     * @return \Illuminate\Http\Response
     * 
     * @OA\Put(
     *      path="/api/book-store/{book_store}",
     *      summary="",
     *      operationId="book-store.update",
     *      tags={"book-store"},
     *      @OA\Response(response=200, description="")
     * )
     */
    public function update(Request $request, $id)
    {
        $model = BookStore::firstOrNew(['id' => $id]);
        $model->fill($request->all());
        $model->save();
        return $model;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookStore  $bookStore
     * @return \Illuminate\Http\Response
     * 
     * @OA\Delete(
     *      path="/api/book-store/{book_store}",
     *      summary="",
     *      operationId="book-store.destroy",
     *      tags={"book-store"},
     *      @OA\Response(response=200, description="")
     * )
     */
    public function destroy($id)
    {
        $model = BookStore::find($id);
        if (! $model) $this->error(404, 'Book does not exists');
        $model->delete();
        return $model;
    }
}
