<?php
declare (strict_types = 1);
/**
 * 路由中间件必须在应用中间件之前
 */
namespace app\middleware;
use think\facade\Session;
use think\facade\Request;
class Login
{
    protected $LoginUrl='login/index';

    protected $HomeUrl='/admin';
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next){
        if (!Session::has('admin') && !stristr(Request::url(),'/login/') ) {
            
             return redirect((string)url($this->LoginUrl)); #去登陆

        }elseif(Session::has('admin') && $this->LoginUrl == $request->url()){
            return redirect((string)url($this->HomeUrl)); #去登陆
        }

        return $next($request); #正常通过

    }
}

