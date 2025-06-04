<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageResource;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $page = Page::get();
        return PageResource::collection($page);
    }

    public function show(Page $page)
    {
        $page = Page::findOrFail($page->getKey());
        return new PageResource($page);
    }
}
