<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpinionItemStoreRequest;
use App\Models\Opinion;
use App\Models\OpinionItem;
use App\Models\Tierlist;
use Illuminate\Contracts\Routing\ResponseFactory;
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
        /** @var Opinion $opinion */
        $opinion = $tierlist->opinions()->where('author_id', \Auth::user()->author->getQueueableId())->first();

        if ($opinion->opinionItems()->where('tierlist_item_id', $request->tierlist_item_id)->first())
            return response()->json([
                'status' => 'error',
                'message' => 'opinionItem with this tierlist_item_id exists!'
            ])->setStatusCode(422);

        $opinionItem = new OpinionItem();
        $opinionItem->fill($request->all());

        $opinionItem->opinion()->associate($opinion);
        $opinionItem->save();

        return $opinionItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param OpinionItem $opinionItem
     * @return OpinionItem|ResponseFactory|Response
     */
    public function update(Tierlist $tierlist, Request $request, OpinionItem $opinionItem)
    {
        if ($opinionItem->opinion->author->getQueueableId() !== \Auth::user()->author->getQueueableId())
            return response('', 401);

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
