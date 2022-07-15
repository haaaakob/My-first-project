<?php

namespace App\Http\Controllers;

use \App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
//    public function save(Request $request)
//    {
//        if (Auth::check()){
//            return redirect(route('user.private'));
//        }
//        $validateFields = $request->validate([
//            'name' => 'required|string|min:3|max:20',
//            'surname' => 'required|string|min:3|max:25',
//            'email' => 'required|email|unique:users',
//            'password' => 'required|alpha_num|min:5',
//            'confirmPassword' => '|same:password',
//            'gender' => 'required'
//        ],
//            [
//                'name.required' => 'Please enter your name',
//                'name.max' => 'Name must not be more than 20 chars',
//                'surname.required' => 'Please enter your surname',
//                'surname.max' => 'Surname must not be more than 20 chars',
//                'email.required' => 'Please enter your email',
//                'email.email' => 'Email must be a valid email address',
//                'password.required' => 'Please enter the password',
//                'password.alpha_num' => 'Password must be alpha numeric chars',
//                'password.min' => 'Password should be minimum 6 chars',
//                'confirmPassword.required' => 'Please enter the password',
//                'confirmPassword.same' => 'Password must be same',
//                'gender.required' => 'Please select the gender',
//
//        ]);
//        $user = User::create($validateFields);
//        if ($user){
//            Auth::login($user);
//            return redirect(route('user.private'));
//        }
//
//        return redirect(route('user.login'))->withErrors([
//           'formErrors' => 'there are some error'
//        ]);
//    }

}
