<?php

namespace App\Http\Controllers;
use App\Models\Group;
use App\Models\Language;
use App\Models\Translation;
use App\Models\Post;
use App\Models\Slider;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use phpDocumentor\Reflection\Type;

class MainController extends Controller
{
    public function login()
    {
        return view('login');
    }
    public function register()
    {
        return view('registration');
    }
    public function save(Request $request)
    {
//        return $request->input();
        $request->validate([
            'name' => 'required|string|min:3|max:20',
            'surname' => 'required|string|min:3|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|alpha_num|min:5',
            'confirmPassword' => '|same:password',
            'gender' => 'required'
        ],
        [
            'name.required' => 'Please enter your name',
            'name.max' => 'Name must not be more than 20 chars',
            'surname.required' => 'Please enter your surname',
            'surname.max' => 'Surname must not be more than 20 chars',
            'email.required' => 'Please enter your email',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Please enter the password',
            'password.alpha_num' => 'Password must be alpha numeric chars',
            'password.min' => 'Password should be minimum 6 chars',
            'confirmPassword.required' => 'Please enter the password',
            'confirmPassword.same' => 'Password must be same',
            'gender.required' => 'Please select the gender',
        ]);
//        $user = User::create($request->all());
        $user = User::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'password' => $request['password'],
            'gender' => $request['gender'],
            'avatar' => '2.png',
        ]);
        if ($user){
            Auth::login($user);
            return back()->with('success','New User has been successfully added to database');
        } else{
            return back()->with('fail','Something went wrong, try again');
        }
    }
    public function check(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|alpha_num|min:5',
        ],
        [
            'email.required' => 'Please enter your email',
            'email.email' => 'Email must be a valid email address',
            'password.required' => 'Please enter the password',
            'password.alpha_num' => 'Password must be alpha numeric chars',
            'password.min' => 'Password should be minimum 6 chars',
        ]);
        $userInfo = User::where('email','=',$request->email)->first();
        if (!$userInfo){
            return back()->with('fail','We do not recognize your email address');
        }else{
            if (Hash::check($request->password, $userInfo->password)){
                $request->session()->put('loggedUser',$userInfo->id);
                return redirect('private');
            }else{
                return back()->with('fail','Incorrect password');
            }
        }
    }
    public function private()
    {
        $userWithImages = ['loggedUser'=>User::where('id','=',session('loggedUser'))->with('images','posts')->withCount('images')->get()];
//        echo '<pre>'.json_encode($userWithImages, JSON_PRETTY_PRINT).'</pre>';die();

//        $data = ['loggedUser'=>User::where('id','=',session('loggedUser'))->first()];
        return view('private', $userWithImages);
    }
    public function logout()
    {
        if(session()->has('loggedUser')){
            session()->pull('loggedUser');
            if (Session()->get('locale') == 'en') {
                return redirect('en/login');
            }else if (Session()->get('locale') == 'ru') {
                return redirect('ru/login');
            }else if (Session()->get('locale') == 'am') {
                return redirect('am/login');
            }
        }
    }
    public function update_avatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|mimes:jpeg,png,jpg|max:5048'
        ],
            [
                'image.mimes' => 'Sorry you con upload only this type jpeg,png,jpg',
                'image.max'=> 'Sorry your file is to large'
            ]);

        if($request->hasFile('avatar')) {
            $avatar     = $request->file('avatar');
            $filename   = time(). '.' . $avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('images/avatar/'), $filename);


//            if (User::get('avatar') != '1.png' && User::get('avatar') != '2.png'){p
//                unlink('images/avatar/');
//            }
//            remove last avatar from folder


            $data = User::find(session('loggedUser'));
            $data->avatar = $filename;
            $data->update();
            return back()
                ->with('success','You have successfully upload image.')
                ->with('image',$filename);
        }
    }

    public function gallery()
    {

        $userWithImages = ['posts'=>Post::with('translation')->paginate(3)];
        $userWithLanguages = ['languages'=>Language::get()];
//        echo '<pre>'.json_encode($userWithImages, JSON_PRETTY_PRINT).'</pre>';die();
        return view('gallery',$userWithImages,$userWithLanguages);
    }
    public function update_gallery(Request $request)
    {


//        $request->validate([
//            'posts' => 'required|mimes:jpeg,png,jpg|max:10000'
//        ],
//            [
//                'image.mimes' => 'Sorry you con upload only this type jpeg,png,jpg',
//                'image.max' => 'Sorry your file is to large'
//            ]);

//        dd($request->file('post'));
//        if ($request->hasFile('posts')) {
            $posts = $request->file('post');
            $filename = time() . '.' . $posts->getClientOriginalExtension();
            $request->post->move(public_path('images/gallery/'), $filename);
//            dd($filename);
//        }

        $user = Post::create(['user_id' => session('loggedUser'),'posts' => $filename, 'status' => 1]);
        $id = $user->id;

        $data = $request->all();
        $title = $data['title'];
        $description = $data['description'];
        $languages = $data['language'];


        for ($i = 0; $i < count($languages); $i++){
            $translations = Translation::create([
                'post_id' => $id,
                'language_id' => $languages[$i],
                'title' => $title[$i],
                'description' => $description[$i],
                'status' => 1
            ]);
        }



//        $map = array_combine($title, $description);
//            foreach ($map as $title => $description) {
//               $translations = Translation::create([
//                    'post_id' => $id,
//                    'language_id' => $languages[$title],
////                    'language_id' => $languages[$key],
//                    'title' => $title,
//                    'description' => $description,
//                    'status' => 1,
//                ]);
//            }


        if ($user && $translations) {
            return back()
                ->with('success', 'You have successfully added image in gallery');
        } else {
            return back()->with('fail', 'Something went wrong, try again');
        }
    }

    public function slider()
    {
//        $userWithImages = User::where('id','=',session('loggedUser'))->with('images')->withCount('images')->get();
////        dd($userWithImages);
//        echo '<pre>'.json_encode($userWithImages, JSON_PRETTY_PRINT).'</pre>';die();

        $images = ['loggedUser'=>Slider::where('user_id','=',session('loggedUser'))->get()];
//        return response()->json($images);
        return view('slider',$images);
    }
    public function slider_save(Request $request)
    {
        $request->validate([
            'images' => 'required|max:10000'
        ],
            [
//                'image.mimes' => 'Sorry you con upload only this type jpeg,png,jpg',
                'image.max' => 'Sorry your file is to large',
            ]);
        $image = array();
        if ($files = $request->file('images')){
            foreach ($files as $file){
                $image_name = md5(rand(1, 100));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $upload_path = 'images/photo/';
                $image_url = $upload_path.$image_full_name;
                $file->move($upload_path, $image_full_name);
                $image[] = $image_url;
            }
        }
        foreach ($image as $img){
            $slider = Slider::create([
                'user_id' => session('loggedUser'),
                'image' => $img
            ]);
        }
//
        if ($slider) {
            return back()
                ->with('success', 'You have successfully added image in gallery');
        } else {
            return back()->with('fail', 'Something went wrong, try again');
        }
    }

    public function edit($url, $id)
    {
        $userWithImages = ['post'=>Post::where('id', $id)->with('translations')->first()];
        $userWithLanguages = ['languages'=>Language::all()];
//        echo '<pre>'.json_encode($userWithImages, JSON_PRETTY_PRINT).'</pre>';die();
        return view('edit',$userWithImages,$userWithLanguages);
    }

    public function add_language($url,$id,$language_id)
    {

//        var_dump($language_id);
//        die();
        $info = 'This post has not captions';
        $add = Translation::create([
            'post_id' => $id,
            'language_id' => $language_id,
            'title' => $info,
            'description' => $info,
            'status' => 1
        ]);
        if ($add){
            $userWithImages = ['post'=>Post::where('id', $id)->with('translations')->first()];
            $userWithLanguages = ['languages'=>Language::all()];
//        echo '<pre>'.json_encode($userWithImages, JSON_PRETTY_PRINT).'</pre>';die();
            return view('edit',$userWithImages,$userWithLanguages);
        }else{
            dd('there are some error');
        }
    }


    public function group()
    {
        $groups = ['groups'=>Group::get()];
        return view('group',$groups);
    }

    public function marge(Request $request)
    {
        $data = $request->all('checkbox');
        $group_id = $request->all('groupName');
        $newGroupName = $request->all('newName');
//        dd($newGroupName['newName']);
        foreach ($group_id as $group){
//            if ($group === 'which group name you choose'){
//                return back()->with('fail', 'You must choose group');
//                dd('validate');
//            }else{
                $g = Group::where('name', '=', $group_id)->get();
//                echo'<pre>'.json_encode($g, JSON_PRETTY_PRINT).'</pre>';
                foreach ($g as $r){
//                    dd($r['id']);
                    foreach ($data as $key => $id) {
                        foreach ($id as $item) {
                            $user_group = UserGroup::where('group_id', '=', $item)->get();
//                            echo '<pre>'.json_encode($user_group, JSON_PRETTY_PRINT).'</pre>';
                            foreach ($user_group as $up) {
                                $updata = UserGroup::find($up['id']);
                                $group_name_update = Group::find($r['id']);
                                $updata->group_id = $r['id'];
//                                $group_name_update->name = $newGroupName['newName'];
                                $group_name_update->name = 'new name 2';
                                $updata->update();
                                $group_name_update->update();
////                        echo '<pre>'.json_encode($user_group, JSON_PRETTY_PRINT).'</pre>';
                            }
                        }

                    }
                }
//            }
        }

//        foreach ($data as $key => $id){
//            foreach ($id as $item){
//                $user_group = UserGroup::where('group_id', '=', $item)->get();
//                echo '<pre>'.json_encode($user_group, JSON_PRETTY_PRINT).'</pre>';
//                foreach ($user_group as $up){
////                    echo $up['id'];
//                    $updata = UserGroup::find($up['id']);
//                    $updata->group_id = $id[0];
//                    $updata->update();
////                    echo '<pre>'.json_encode($user_group, JSON_PRETTY_PRINT).'</pre>';
//                }
//            }
//        }
    }


}



