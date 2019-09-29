<?php

namespace App\Providers;

use App\Models\OpinionItem;
use App\Models\Tierlist;
use App\Models\TierlistItem;
use App\Models\TierlistKarma;
use App\Observers\OpinionItemObserver;
use App\Observers\TierlistItemObserver;
use App\Observers\TierlistKarmaObserver;
use App\Observers\TierlistObserver;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Resource::withoutWrapping();
        Tierlist::observe(TierlistObserver::class);
        TierlistItem::observe(TierlistItemObserver::class);
        TierlistKarma::observe(TierlistKarmaObserver::class);
        OpinionItem::observe(OpinionItemObserver::class);
    }
}
