<?php
declare (strict_types = 1);

namespace app\backend\controller;
use think\facade\Request;
use think\facade\Session;

class User 
{
    public function login()
    {	
    	
    	dump(session('admin'));

    	return view() ;

    }

    public function toLogin(){
    	Session::set('admin.username','123123');
    	
    	return redirect("/backend/index/index");
    	
    }

    public function getLogin(){
    	$admin =session('admin');
    	return $admin;
    }

    public function loginOut(){
    	session::pull('admin');
    	return redirect("/backend/user/login");

    }
}
