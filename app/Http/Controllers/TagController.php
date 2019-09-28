<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagFindRequest;
use App\Http\Requests\TagStoreRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagController extends Controller
{
    public function index(TagFindRequest $request)
    {
        if ($request->q)
            return Tag::where('name', 'like', `%${request->q}%`)->paginate();

        return Tag::paginate();
    }

    public function find(TagFindRequest $request)
    {
        return Tag::where('name', 'like', `%${request->q}%`)
            ->paginate();
    }

    public function store(TagStoreRequest $request)
    {
        return Tag::create($request->only('name'));
    }
}
