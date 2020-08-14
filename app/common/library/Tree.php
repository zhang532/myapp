<?php
namespace app\common\library;

class Tree{

    static public function SortTree($data, $pid = 0, $level=0, $icon = array('&ensp;├─', '&ensp;└─','&ensp;│'))
       {
          $str="";
          $arr=[]; 
          if(empty($data)) return array();
           foreach ($data as $k=>$v) {
               if ($v['pid'] == $pid) {
                   $v['level']= $level+1;
                   if($v['level']>2){
                       $str=str_repeat($icon[2], $v['level']-2);
                   }
                   if($v['pid']== 0){
                       $v['html']='';
                   }else{
                       $v['html']= $str . $icon[0];
                   }
                   
                   $arr[] =$v;
                   $arr = array_merge($arr, self::SortTree($data, $v['id'], $level + 1));
                   
               }	
           }
           return $arr;
       }
       static public function getTree($data,$icon = array('&ensp;├─', '&ensp;└─','&ensp;│')){
           if(!is_array($data) || empty($data)) return array();
           $arr = self::SortTree($data, $pid = 0, $level=0, $icon = array('&ensp;├─', '&ensp;└─','&ensp;│'));
           foreach ($arr as $k => $v) {
               $str = ""; 
               if ($v['level'] > 2) {
                   for ($i = 1; $i < $v['level'] - 1; $i++) {
                       $str .= "&ensp;│";
                   }
               }
                   if($v['level']!=1){
                   if (isset($arr[$k + 1]) && $arr[$k + 1]['level'] >= $arr[$k]['level']) {
                       $arr[$k]['html'] =$str . $icon[0];
                   } else {
                       $arr[$k]['html'] = $str .  $icon[1];
                   }
               }else{
                   $arr[$k]['html'] = $v['html'];
               }

           }
           return $arr;
       }

      static public function getTreeMenu($data, $pid=0,$level=0)
       {
       $html = '';
       foreach($data as $k => $v)
       {
        if($v['pid'] == $pid)
        { //父亲找到儿子
        if($v['is_href'] == 0 || self::getFatherChild($data,$v['id']) == true){
             $html .= '<li class="nav-item  nav-item-has-subnav "><a href="javascript:;"><i class="mdi '.$v['icon'].'"></i>'.$v['name'].'</a>';
        }else{
            $level=$level+1;
            if($v['pid'] == 0 ||$level > 1 ){
                $html .= '<li class="nav-item" ><a href="'.url($v['title']).'"><i class="mdi '.$v['icon'].'"></i>'.$v['name'].'</a>';
            }else{
                $html .= '<li class="nav-item  nav-item-has-subnav " ><a href="'.url($v['title']).'"><i class="mdi '.$v['icon'].'"></i>'.$v['name'].'</a>';
            }
        }
        $html .= self::getTreeMenu($data, $v['id'],$level+1);
        $html = $html."</li>";
        }
       }
       $html=$html ? '<ul class="nav nav-drawer nav-'.$level.'-'.$v['is_href'].'" >'.$html.'</ul>' : $html;
    //    html_entity_decode()
       return $html;
       
       }

       //看看父亲有没有儿子
       static public function getFatherChild($data,$pid){
           $list=array_column($data,'pid');
           
           return array_search($pid,$list);
            
       }
   }