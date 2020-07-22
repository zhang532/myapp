<?php
declare (strict_types = 1);

namespace app\middleware;
use think\facade\Session;
use think\facade\Request;

class Login
{
    protected $url='/backend/user/login';
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next){

        //session & url
        if (!Session::has('admin') &&  strstr('/backend/user/',Request::url()) ) {
            
            return redirect($this->url);
        }
            return $next($request);
        

    }
}

