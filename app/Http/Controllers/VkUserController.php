<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\VkUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VkUserController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  VkUser  $vkUser
     * @return Author
     */
    public function show(VkUser $vkUser)
    {
        return $vkUser->author;
    }
}
