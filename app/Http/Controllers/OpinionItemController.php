<?php

namespace App\Http\Controllers;

use App\Models\OpinionItem;
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
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return \response()->setStatusCode(501);
    }

    /**
     * Display the specified resource.
     *
     * @param OpinionItem $opinionItem
     * @return OpinionItem
     */
    public function show(OpinionItem $opinionItem)
    {
        return $opinionItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param OpinionItem $opinionItem
     * @return OpinionItem
     */
    public function update(Request $request, OpinionItem $opinionItem)
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
