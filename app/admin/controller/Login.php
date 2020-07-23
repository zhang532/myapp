<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\captcha\facade\Captcha;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;
use app\admin\library\Backend;

class Login extends Backend
{	
	public function __construct()
	{
		parent::__construct();
		View::layout(false);
	}

    public function index()
    {	
		
    	return view();

    }
	/**
	 * 登陆
	 */
    public function toLogin(Request $request){
		if(!$request->isPost())  throw new \think\Exception('异常消息', 10006);
		$params=$request;
		
		
    	Session::set('admin.username','fantastic');
    	
    	return redirect((string)url("/console/index"));
    	
    }
	/**
	 * 获取登陆信息
	 */
    public function getLogin(){
    	$admin =session('admin');
    	return $admin;
    }
	/**
	 * 注销
	 */
    public function loginOut(){
    	session::pull('admin');
    	return redirect((string)url("/login/index"));

    }
	
	/**
	 * 验证码
	 */
	public function verify()
	{
		return Captcha::create();    
	}
}
