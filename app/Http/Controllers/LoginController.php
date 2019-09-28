<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Models\VkUser;
use DemeterChain\A;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        $user = VkUser::find($request->id);

        if (!$user) {
            $user = VkUser::create($request->only('id'));
        }

        $author = $user->author;

        if (!$author) {
            $author = new Author();
            $author->vkUser()->associate($request->id);
            $author->save();
            $author->first_login = true;
        }

        $author->token = auth()->login($user);
        return AuthorResource::make($author);
    }
}
