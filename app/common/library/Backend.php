<?php
namespace common\library\traits;
/**
 * 该类为curd基类
 */
trait Backend{

    public function index(){

    }

    /**
     * 添加
     */
    public function add(){

        return $this->view->fetch();
    }

    /**
     * 修改
     */
    public function edit(){

        return $this->view->fetch();
    }

    /**
     * 删除
     */
    public function del(){

    }


}