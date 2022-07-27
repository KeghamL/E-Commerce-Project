<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Mockery\Generator\StringManipulation\Pass\Pass;

class UserController extends Controller
{
    public function registration()
    {

        return view('auth.register');
    }

    public function login()
    {

        return view('auth.login');
    }

    public function registerUser(Request $request)
    {

        $request->validate([

            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            //'password' => ['required ', ' string', 'confirmed', Password::min(8)->letters()->numbers()->mixedCase()->symbols()],
            'password' => 'required|min:3|max:8',
            'repassword' => 'required|same:password',
            'birthday' => 'required|before:5 years ago',
            'gender' => 'required'

        ]);

        $user = new User();
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $res = $user->save();
        if ($res == true) {
            return redirect('login')->with('success', 'User Register Successfully!');
        } else {

            return back()->with('fail', 'Something Went Wrong!');
        }
    }

    public function loginUser(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        dd($user = auth()->user());
        auth()->attempt($request->only(['email', 'password']));

        if ($user = auth()->user()) {
            $products = Product::paginate(6);

            return view('auth.dashboard', compact("products"));
        } else {
            return back()->with('fail', 'Password Didnt Match!');
        }
    }


    public function userInfo()
    {
        $user = auth()->user();
        return view('auth.userinfo', compact('user'));
    }



    public function logout()
    {
        auth()->logout();
        return redirect('login');
    }
}
