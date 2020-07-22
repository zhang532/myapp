<?php
declare (strict_types = 1);

namespace app\backend\controller;
use think\facade\Request;
use think\facade\Session;

class User 
{
    public function login()
    {	
    	

    	return view() ;

    }

    public function tologin(){
    	Session::set('admin.username','123123');
    	
    	return redirect("/backend/index/index");
    	
    }

    public function loginout(){
    	session::pull('admin');
    	return redirect("/backend/user/login");

    }
}
