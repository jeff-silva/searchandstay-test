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
    public function index()
    {
        return (new BookStore)->paginate();
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
        return ['store'];
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
    public function show(BookStore $bookStore)
    {
        return ['show', $bookStore];
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
    public function update(Request $request, BookStore $bookStore)
    {
        return ['update', $bookStore];
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
    public function destroy(BookStore $bookStore)
    {
        return ['destroy', $bookStore];
    }
}
