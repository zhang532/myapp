<?php
namespace common\library\traits;
use think\Db;
use Exception;
/**
 * 该类为curd基类
 */
trait Backend{

    public function index(){
       
        if($this->request->request('search_keys')){
           return $this->searchpage();
        }
        list($where,$order,$sort)=$this->buildparams();
        $list=$this->model->where($where)->order($order)->sort($sort)->paginate();
        $this->assign(['list'=>$list]);
        return $this->view->fetch();
    }

    public function buildparams(){

    }

    public function searchpage(){

    }
    /**
     * 添加
     */
    public function add(){
        if($this->request->isPost()){
            $params = $this->request->post("row/a");
            try {
                $result = $this->model->allowField(true)->save($params);
                // 提交事务
                Db::commit();
            } catch (Exception $e) {
                // 回滚事务
                Db::rollback();
            }

            if ($result !== false) {
                $this->success();
            } else {
                $this->error('未插入数据！');
            }
        }
        return $this->view->fetch();
    }

    /**
     * 修改
     */
    public function edit($ids=null){
        $row=$this->model->get($ids);
        if (!$row) {
            $this->error('未找到');
        }
        if($this->request->isPost()){
            $params = $this->request->post("row/a");
            try {
                $result = $row->allowField(true)->save($params);
                // 提交事务
                Db::commit();
            } catch (Exception $e) {
                // 回滚事务
                Db::rollback();
            }

            if ($result !== false) {
                $this->success();
            } else {
                $this->error('未更新数据！');
            }
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }

    /**
     * 删除
     */
    public function del($ids=''){
        $pk=$this->model->getPk();

        if ($ids) {
            $this->model->where($pk, 'in', $ids);
        }
        // 启动事务
        Db::startTrans();
        $count=0;
        try {
            $list = $this->model->onlyTrashed()->select();
            foreach ($list as $k => $v) {
                $count += $v->delete(true);
            }
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
        }

        if ($count) {
            $this->success();
        } else {
            $this->error('未删除任何数据！');
        }
        $this->error('参数错误！');
    }


}