<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class LoginController extends Controller
{
    public function login(Request $req)
    {
    	$user =  User::where('name', $req->input('uname'))->first();
    	if(!empty($user))
    	{
    		if(Crypt::decrypt($user->password) == $req->input('pwd'))
    		{
    			$req->session()->put('user_id',$user->id);
                $req->session()->put('user_name',$user->name);
    			return redirect('admin-dashboard');
    		}
    	}
    	$req->session()->flash('login_status', 'Invalid Login Details');
    	return redirect('/login');
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        return redirect('/');
    }
}
