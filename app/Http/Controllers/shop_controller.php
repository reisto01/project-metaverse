<?php

namespace App\Http\Controllers;

use App\Models\maps_metaverse;
use App\Models\prop_metaverse;
use Illuminate\Http\Request;

class shop_controller extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search_me')->trim()->toString();
        $filter = fn ($query) => $query
            ->where('is_deleted', 1)
            ->when($search, fn ($query) => $query->where('title', 'like', '%'.$search.'%'))
            ->orderBy('price');

        return view('userpage.shop', [
            'land' => $filter(maps_metaverse::query())->limit(24)->get(),
            'properties' => $filter(prop_metaverse::query())->limit(24)->get(),
            'search' => $search,
        ]);
    }
}
