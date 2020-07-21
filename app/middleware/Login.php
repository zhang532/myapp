<?php
declare (strict_types = 1);

namespace app\middleware;
use think\facade\Session;
class Login
{
    /**
     * 处理请求
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next){
        $url =url('backend/user/login');

        if (!Session::has('admin') && $request->url() != $url) {

             return redirect((string)$url);
        }
         return $next($request);
        

    }
}

