<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\captcha\facade\Captcha;
use think\facade\Request;
use think\facade\Session;
use think\facade\View;
use app\admin\library\Backend;
use app\admin\model\Admin;
use think\exception\ValidateException;

class Login extends Backend
{	
	public function __construct()
	{
		parent::__construct();
		View::layout(false);
		$this->model=new Admin;
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
		$check = $request->checkToken('__token__');
        
        if(false === $check) {
            throw new ValidateException('invalid token');
		}
		
		$params=$request;
		$result=Admin::where(['username'=>$params['username'] ,'password'=>$this->model->encryptPassword($params['password'])])->find();
		if($result){
			Session::set('admin',$result);
			return json(['code'=>200,'msg'=>'登陆成功']);
		}else{
			return json(['code'=>0,'msg'=>'登陆失败']);
		}

    	
    	
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
