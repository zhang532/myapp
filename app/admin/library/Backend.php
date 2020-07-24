<?php
namespace app\admin\library;

use think\facade\Request;
use think\facade\Session;
use think\facade\View;
use app\common\library\Auth;

/**
* 后台基类控制
*/
class Backend extends Auth
{
	
	use \app\admin\library\traits\Backend ;
	
	public function __construct()
	{
		parent::__construct();
		//模板引擎
		View::layout('Layouts/container');
		View::assign([
			'config'	=>$this->config(),
		]);
	}
	public function config(){
		$arr=[
			'controller_name'=>strtolower(Request::controller()),
			'action_name'=>strtolower(Request::action()),
		];
		
		return $arr;

	}
}