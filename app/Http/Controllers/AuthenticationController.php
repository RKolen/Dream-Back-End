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
}
