<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookStore;
use App\Repositories\BookCategoryRepository;

class BookCategoryController extends Controller
{
    private $repository;

    public function __construct(BookCategoryRepository $repository)
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
    }

    /**
     * Display a listing of books.
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/api/book-category",
     *      summary="",
     *      operationId="book-category.index",
     *      tags={"book-category"},
     *      security={{ "bearer_token": {} }},
     *      @OA\Parameter(in="query", name="page", example="1"),
     *      @OA\Parameter(in="query", name="per_page", example="10"),
     *      @OA\Parameter(in="query", name="term", example=""),
     *      @OA\Response(response=200, description="")
     * )
     */
    public function index(Request $request)
    {
        return $this->repository->index($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * @OA\Post(
     *      path="/api/book-category",
     *      summary="",
     *      operationId="book-category.store",
     *      tags={"book-category"},
     *      security={{ "bearer_token": {} }},
     *      @OA\RequestBody(@OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="name", type="string", example="")
     *      )),
     *      @OA\Response(response=200, description="")
     * )
     */
    public function store(Request $request)
    {
        $this->repository->validate($request);
        return $this->repository->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BookStore  $bookStore
     * @return \Illuminate\Http\Response
     * 
     * @OA\Get(
     *      path="/api/book-category/{book_category}",
     *      summary="",
     *      operationId="book-category.show",
     *      tags={"book-category"},
     *      security={{ "bearer_token": {} }},
     *      @OA\Parameter(in="path", name="book_category", example="1"),
     *      @OA\Response(response=200, description="")
     * )
     */
    public function show($id)
    {
        return $this->repository->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BookStore  $bookStore
     * @return \Illuminate\Http\Response
     * 
     * @OA\Put(
     *      path="/api/book-category/{book_category}",
     *      summary="",
     *      operationId="book-category.update",
     *      tags={"book-category"},
     *      security={{ "bearer_token": {} }},
     *      @OA\Parameter(in="path", name="book_category", example="1"),
     *      @OA\RequestBody(@OA\JsonContent(
     *          type="object",
     *          @OA\Property(property="name", type="string", example="")
     *      )),
     *      @OA\Response(response=200, description="")
     * )
     */
    public function update(Request $request, $id)
    {
        $this->repository->validate($request);
        return $this->repository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BookStore  $bookStore
     * @return \Illuminate\Http\Response
     * 
     * @OA\Delete(
     *      path="/api/book-category/{book_category}",
     *      summary="",
     *      operationId="book-category.destroy",
     *      tags={"book-category"},
     *      security={{ "bearer_token": {} }},
     *      @OA\Parameter(in="path", name="book_category", example="1"),
     *      @OA\Response(response=200, description="")
     * )
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
