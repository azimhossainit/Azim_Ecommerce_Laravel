<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $user = auth('web')->user();
        $wishlists = Wishlist::where('user_id', $user?->id)->get();
        return view('web.wishlist', compact('user', 'wishlists'));
    }
}

