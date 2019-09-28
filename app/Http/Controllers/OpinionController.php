<?php

namespace App\Http\Controllers;

use App\Http\Resources\OpinionResource;
use App\Models\Opinion;
use App\Models\Tierlist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OpinionController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Tierlist $tierlist
     * @return Response
     */
    public function show(Tierlist $tierlist)
    {
        return OpinionResource::make($tierlist->sum_opinion);
    }

    public function showAuthor(Tierlist $tierlist)
    {
        return OpinionResource::make($tierlist->author_opinion);
    }

    public function showMe(Tierlist $tierlist)
    {
        return OpinionResource::make(
            $tierlist->opinions()->firstOrCreate(['author_id' =>\Auth::user()->author->getQueueableId()])
        );
    }
}
