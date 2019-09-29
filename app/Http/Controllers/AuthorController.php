<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthorResource;
use App\Models\Author;
use Auth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return LengthAwarePaginator|Response
     */
    public function index()
    {
        return Author::paginate();
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return AuthorResource|Author
     */
    public function show(Author $author)
    {
        return AuthorResource::make($author->load(['tierlists']));
    }

    public function me()
    {
        return Auth::user()->author;
    }

    public function tierlists(Author $author)
    {
        return $author->tierlists()->paginate();
    }
}
