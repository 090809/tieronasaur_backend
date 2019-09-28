<?php

namespace App\Http\Controllers;

use App\Http\Requests\TierlistFriendRequest;
use App\Http\Requests\TierlistPopularRequest;
use App\Http\Requests\TierlistStoreRequest;
use App\Http\Resources\TierlistResource;
use App\Models\Author;
use App\Models\Tierlist;
use App\Models\TierlistItem;
use App\Models\TierlistItemStat;
use App\Services\ImageUploader;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TierlistController
 * @package App\Http\Controllers
 * @property ImageUploader $uploader
 */
class TierlistController extends Controller
{
    protected $uploader;

    public function __construct(ImageUploader $imageUploader)
    {
        $this->uploader = $imageUploader;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tierlist::newly()->paginate();
    }

    public function popularIndex(TierlistPopularRequest $request)
    {
        $lastOpened = Carbon::createFromFormat('Y-m-d H:i:s', $request->last_opened);
        return Tierlist::popular($lastOpened)->paginate();
    }

    public function friendIndex(TierlistFriendRequest $request)
    {
        return Tierlist::friends($request->friends)->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TierlistStoreRequest $request
     * @return Tierlist
     */
    public function store(TierlistStoreRequest $request)
    {
        if ($request->has(['community_id', 'community_token'])) {
            return $this->storeAsCommunity($request);
        }

        return $this->createTierlist($request, \Auth::user()->author);
    }

    private function createTierlist(TierlistStoreRequest $request, Author $author)
    {
        $tierlist = Tierlist::create($request->except(['items']));
        $tierlist->author()->associate(\Auth::user());

        foreach ($request->file('items') as $item) {
            $tierlistItem = TierlistItem::create();
            $path = $this->uploader->upload($item);

            $tierlistItem->img = $path;

            $tierlistItem->stat()->create();
            $tierlistItem->tierlist()->associate($tierlist);
        }

        return $tierlist;
    }

    private function storeAsCommunity(TierlistStoreRequest $request)
    {
        if ($this->validateCommunity($request->community_id, $request->community_token))
            return response()->setStatusCode(401);

        $author = Author::firstOrCreate(
            ['community_id' => $request->community_id],
            [
                'comminity_id' => $request->community_id,
                'vk_user_id' => null,
            ]
        );

        return $this->createTierlist($request, $author);
    }

    private function validateCommunity(int $community_id, string $token) : bool
    {
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param Tierlist $tierlist
     * @return TierlistResource
     */
    public function show(Tierlist $tierlist)
    {
        return TierlistResource::make($tierlist);
    }
}
