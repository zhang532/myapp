<?php
namespace common\library\traits;
use think\Db;
use Exception;
/**
 * 该类为curd基类
 */
trait Backend{

    public function index(){
        
        
        if($this->request->request('keyField')){
           return $this->searchPage();
        }
        list($where,$order,$sort,$limit,$offset)=$this->buildParams();
        $list=$this->model->where($where)->order($order,$sort)->limit($offset,$limit)->select();
        $this->assign(['list'=>$list]);
        return $this->view->fetch();
    }

    /***
     * 查询条件
     */
    public function buildParams(){
        $params = $this->request->request();
        $list['order']    = $params['order']; //'id_desc,sort_desc'
        $list['sort']     = $params['sort'];
        $list['limit']    = $params['limit'];
        $list['offset']   = $params['offset'];
        $params['filter'] = explode(',',$params['filter']);
        //设置查询参数
        $condition ='like %...%';
        $condition ='not like %...%';

        $list['where']=$params['filter'];
        
        return $list;
    }
    /**
     * 搜索
     */
    public function searchPage(){
        $params = $this->request->request();

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