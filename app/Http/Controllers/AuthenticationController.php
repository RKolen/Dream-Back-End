<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        	echo "GTFO!";
        }
    }

    public function checklogin () 
    {
    	if (isset($_COOKIE['notpassword']) && isset($_COOKIE['email'])) {

    		echo $_COOKIE['notpassword'];
    		echo $_COOKIE['email'];
    	} else {
    		echo "cookies not found";
    	}
	}

	public function logout()
    {
       setcookie('email', "", time() -3600);
        	setcookie('notpassword', "", time() -3600);
    }
}
