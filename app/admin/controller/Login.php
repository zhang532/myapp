<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\captcha\facade\Captcha;
use think\Request;
use think\facade\Session;
use think\facade\View;
use app\admin\library\Backend;
use app\admin\model\Admin;
use think\exception\ValidateException;

class Login extends Backend
{	
	public function __construct(Request $request)
	{
		parent::__construct();
		$this->request=$request;
		$this->layouts(false);
		$this->model=new Admin;
	}

    public function index()
    {	
		
    	return view();

    }
	/**
	 * 登陆
	 */
    public function toLogin(){
		if(!$this->request->isPost())  throw new \think\Exception('异常消息', 10006);
		$params=$this->request;

		$check = $this->request->checkToken('__token__');
        
        if(false === $check) {
            return json(['code'=>0,'msg'=>'表单令牌有误','__token__'=>token()]);
		}
		if( !captcha_check($params['captcha']))
		{
			// 验证失败
			return json(['code'=>0,'msg'=>'验证码错误','__token__'=>token()]);
		}
		
		$result=Admin::where(['username'=>$params['username'] ,'password'=>$this->model->encryptPassword($params['password'])])->find();
		if($result){
			Session::set('admin',$result);
			return json(['code'=>200,'msg'=>'登陆成功','url'=>(string)url('/console/index') ]);
		}else{
			return json(['code'=>0,'msg'=>'用户名或密码错误','__token__'=>token()]);
		}

    	
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
