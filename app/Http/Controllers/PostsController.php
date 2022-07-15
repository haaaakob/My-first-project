<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
//    public function gallery()
//    {
//        return view('gallery');
//    }
//
//    public function update_gallery(Request $request)
//    {
//        $request->validate([
//            'posts' => 'required|mimes:jpeg,png,jpg|max:10000'
//        ],
//            [
//                'image.mimes' => 'Sorry you con upload only this type jpeg,png,jpg',
//                'image.max' => 'Sorry your file is to large'
//            ]);
//
//        if ($request->hasFile('posts')) {
//            $posts = $request->file('posts');
//            $filename = time() . '.' . $posts->getClientOriginalExtension();
//
////            user_id in db
////   dd(Auth::hasUser());
//            $request->posts->move(public_path('images/gallery/'), $filename);
//        }
//            $user = Posts::create(['user_id' => Auth::id(),'posts' => $filename, 'status' => 1]);
//            if ($user) {
//                return back()
//                    ->with('success', 'You have successfully added image in gallery');
//            } else {
//                return back()->with('fail', 'Something went wrong, try again');
//            }
//        }

//    public function gallery(Request $request)
//    {
//        $countries = DB::table('users')->paginate(3);
//        $countries->appends($request->all());
//        return view('gallery',['posts'=>$countries]);

//        $user_data = ['posts'=>Posts::paginate(3)];
//        return view('gallery',$user_data);
//    }
}
