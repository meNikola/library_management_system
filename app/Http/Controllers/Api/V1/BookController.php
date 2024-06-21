<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\BookFilter;
use App\Models\Book;
use App\Http\Requests\Api\V1\StoreBookRequest;
use App\Http\Requests\Api\V1\UpdateBookRequest;
use App\Http\Resources\V1\BookResource;
use App\Policies\V1\BookPolicy;

class BookController extends ApiController
{
    protected $policyClass = BookPolicy::class;

    /**
     * Display a listing of the resource.
     */
    public function index(BookFilter $filters)
    {
        return BookResource::collection(Book::filter($filters)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        // Policy.
        if ($this->isAble('store', Book::class)) {
            // Request params.
            $params = $request->mappedAttributes();

            // Create book.
            $book = Book::create($params);

            // Attach book roles.
            $book->authors()->attach($params['author_ids']);

            return new BookResource($book->load('authors'));
        }

        return $this->notAuthorized('You are not authorized to create that resource');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return new BookResource($book->load('authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        // Policy.
        if ($this->isAble('update', $book)) {
            $params = $request->mappedAttributes();

            $book->update($params);

            // Attach book roles.
            $book->authors()->sync($params['author_ids']);

            return new BookResource($book->load('authors'));
        }

        return $this->notAuthorized('You are not authorized to update that resource');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Policy.
        if ($this->isAble('delete', $book)) {
            $book->delete();

            return $this->ok('Book successfully deleted');
        }

        return $this->notAuthorized('You are not authorized to delete that resource.');
    }
}
