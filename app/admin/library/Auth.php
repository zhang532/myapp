<?php
namespace app\admin\library;

use think\facade\Request;
use think\facade\Session;
use think\facade\View;
/**
* 后台基类控制
*/
class Auth 
{
	
	function __construct()
	{
		//模板引擎
			View::layout('Layouts/container');
		
	}
}