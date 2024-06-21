<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\UserFilter;
use App\Http\Requests\Api\V1\StoreAuthorRequest;
use App\Http\Requests\Api\V1\UpdateAuthorRequest;
use App\Http\Resources\V1\AuthorResource;
use App\Models\Author;
use App\Policies\V1\AuthorPolicy;

class AuthorController extends ApiController
{
    protected $policyClass = AuthorPolicy::class;

    /**
     * Display a listing of the resource.
     */
    public function index(UserFilter $filters)
    {
        return AuthorResource::collection(
            Author::filter($filters)->paginate()
        );
    }

    public function store(StoreAuthorRequest $request)
    {
        // Policy.
        if ($this->isAble('store', Author::class)) {
            return new AuthorResource(Author::create($request->mappedAttributes()));
        }

        return $this->notAuthorized('You are not authorized to create that resource');
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        if ($this->include('books')) {
            return new AuthorResource($author->load('books'));
        }

        return new AuthorResource($author);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuthorRequest $request, Author $author)
    {
        // Policy.
        if ($this->isAble('update', $author)) {
            $author->update($request->mappedAttributes());

            return new AuthorResource($author);
        }

        return $this->notAuthorized('You are not authorized to update that resource');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        // Policy.
        if ($this->isAble('delete', $author)) {
            $author->delete();

            return $this->ok('Author successfully deleted');
        }

        return $this->notAuthorized('You are not authorized to delete that resource.');
    }
}
