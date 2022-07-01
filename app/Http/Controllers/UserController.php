<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
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
            'birthday' => 'required',
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

        $user = User::where('email', '=', $request->email)->first();
        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                $request->session()->put('loginId', $user->id);
                $request->session()->put('user', $user);

                $products = Product::paginate(6);

                return view('auth.dashboard', compact("user", "products"));
            } else {
                return back()->with('fail', 'Password Didnt Match!');
            }
        } else {
            return back()->with('fail', 'This Email Is Not Registered!');
        }
    }


    public function userInfo()
    {
        $date = array();
        if (Session::has('loginId')) {
            $data = User::where('id', '=', Session::get('loginId'))->first();
        }
        return view('auth.userinfo',  compact('data'));
    }



    public function logout(Request $request)
    {

        Session::flush();
        return redirect('login');
    }
}
