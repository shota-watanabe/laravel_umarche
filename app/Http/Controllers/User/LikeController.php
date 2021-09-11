<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Like;

class LikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:users')->only(['like', 'unlike']);
    }

    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->likes;

        return view('user.likes', compact('products'));
    }
    public function like(Request $request)
    {
        Like::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
          ]);

          return back();
    }

    public function unlike($id)
    {
        $like = Like::where('product_id', $id)->where('user_id', Auth::id());
        $like->delete();

        return back();
    }
}
