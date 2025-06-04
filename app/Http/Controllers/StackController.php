<?php

namespace App\Http\Controllers;

use App\Http\Resources\StackResource;
use App\Models\Stack;
use Illuminate\Http\Request;

class StackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stacks = Stack::get();
        return StackResource::collection($stacks);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stack $stack)
    {
        return new StackResource($stack);
    }
}
