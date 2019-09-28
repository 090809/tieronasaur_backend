<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpinionItemStoreRequest;
use App\Models\OpinionItem;
use App\Models\Tierlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OpinionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return \response()->setStatusCode(501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Tierlist $tierlist
     * @param OpinionItemStoreRequest $request
     * @return OpinionItem|Model
     */
    public function store(Tierlist $tierlist, OpinionItemStoreRequest $request)
    {
        return OpinionItem::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param OpinionItem $opinionItem
     * @return OpinionItem
     */
    public function update(Tierlist $tierlist, Request $request, OpinionItem $opinionItem)
    {
        $opinionItem->update($request->only(['vote']));
        return $opinionItem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param OpinionItem $OpinionItem
     * @return Response
     */
    public function destroy(OpinionItem $OpinionItem)
    {
        return \response()->setStatusCode(501);
    }
}
