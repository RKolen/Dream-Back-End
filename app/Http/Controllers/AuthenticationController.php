<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthenticationController extends Controller
{
	public function test() 
    {
        return view('/test');
    }

    public function login()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) 
        {
        	setcookie('email', $_POST['email'], time() + (86400*30), "/");
        	setcookie('notpassword', $_POST['password'], time() + (86400*30), "/");
        	echo "login successful";
        } else {
        	echo "login failed";
        }
    }

    public function checklogin () 
    {
        $logindetails = new \stdClass();
        $logindetails->loggedin = false;

    	if (isset($_COOKIE['notpassword']) && isset($_COOKIE['email'])) {

            $password = $_COOKIE['notpassword'];
            $email = $_COOKIE['email'];
            $user = User::where('email', $email)->first();


            if(!$user == null) 
            {   
                $passwordcorrect = password_verify ($password, $user->password);
                if($passwordcorrect == true) 
                {   
                    $logindetails->loggedin = true;

                    $logindetails->name = $user->name;
                    $logindetails->id = $user->id;
                }
            }
    	}

        $json = json_encode($logindetails);

        return $json;
	}

	public function logout()
    {
       setcookie('email', "", time() -3600);
        	setcookie('notpassword', "", time() -3600);
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();


        // setcookie('email', $request->input('email'), time() + (86400*30), "/", env('DOMAIN_NAME'));
        // setcookie('notpassword', $request->input('password'), time() + (86400*30), "/", env('DOMAIN_NAME'));

        return \Response::json(array('success' => true ))->header('Access-Control-Allow-Origin', '*');
        
    }
}
