<?php
namespace app\admin\library\traits;
use think\facade\Db;
use think\facade\Request;
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

    /**
     * 查询条件
     */
    public function buildParams(){
        $params = $this->request->request();
        $list['order']    = $params['order']; //'id_desc,sort_desc'
        $list['sort']     = $params['sort'] ?? $this->model->getPk();
        $list['limit']    = $params['limit'];
        $list['offset']   = $params['offset'];
        $filter = json_decode($params['filter'],true);
        //设置查询参数
        $op =json_decode($params['op'],true);

        $where =[];
        foreach($filter as $k=>$v){
            switch ($op[$k]) {
                case 'LIKE':
                    $where[]=[$k,'LIKE','%'.$v.'%'];
                    break;
                
                case 'FIND_IN_SET':
                    $where[]=['exp',Db::raw("FIND_IN_SET($v,$k)")];
                    break;
                case 'BETWEEN':
                    $where[]=[$k,'BETWEEN',$v];
                    break;
                case 'NULL':
                    $where[]=[$k,'=',null];
                    break;
                case 'IN':
                    $where[]=[$k,'in',$v];
                    break;
                case '=':
                    $where[]=[$k,'=',$v];
                    break;   
                case '>':
                    $where[]=[$k,'>',$v];
                    break; 
                case '<':
                    $where[]=[$k,'<',$v];
                    break;         
            }
        }

        $list['where']=$where;
        
        return $list;
    }
    /**
     * 搜索
     */
    public function searchPage(Request $request){

        $request= $request->filter(['strip_tags', 'htmlspecialchars']);
        $params = $request->request();
        

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