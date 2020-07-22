<?php
declare (strict_types = 1);

namespace app\admin\controller;


use think\facade\Request;
use think\facade\Session;

class User 
{
    public function login()
    {	
    	
    	// dump(session('admin'));
      

    	return view() ;

    }

    public function toLogin(){
    	Session::set('admin.username','fantastic');
    	
    	return redirect((string)url("/index/index"));
    	
    }

    public function getLogin(){
    	$admin =session('admin');
    	return $admin;
    }

    public function loginOut(){
    	session::pull('admin');
    	return redirect((string)url("/user/login"));

    }
}
