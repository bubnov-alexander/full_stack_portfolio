<?php

namespace App\Http\Controllers;

use App\Http\Resources\SocialResource;
use App\Models\Social;
use Illuminate\Http\Request;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $social = Social::with('media')->get();
        return SocialResource::collection($social);
    }

    /**
     * Display the specified resource.
     */
    public function show(Social $social)
    {
        $social->with('media')
            ->findOrFail($social->getKey());
        return new SocialResource($social);
    }
}
