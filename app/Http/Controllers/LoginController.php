<?php

namespace App\Http\Controllers;

use App\Http\Middleware\VkMiniAppPass;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Models\VkUser;
use DemeterChain\A;
use Illuminate\Http\Request;
use JWTAuth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->middleware(VkMiniAppPass::class, ['only' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        $user = VkUser::find($request->id);

        if (!$user) {
            VkUser::create($request->only('id'));
            $user = VkUser::find($request->id); // TODO: *Bug: Не работает токен в обычном случае.
        }

        $author = $user->author;

        if (!$author) {
            $author = new Author();
            $author->vkUser()->associate($request->id);
            $author->save();
            $author->first_login = true; // magic value for AuthorResource
        }

        $author->token = JWTAuth::fromUser($user);
        return AuthorResource::make($author);
    }
}
