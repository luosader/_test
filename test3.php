<?php
/**
 * 类或方法测试
 */
require '_lib/func.php';


class Name extends ExtendsName
{
    public function compare()
    {
        
    }

    public function format($data) {
        if(!$data) return array();
        if(is_one_dimension($data)) $data = array('_key_' => $data);
        
        $product = array();
        $area = array();
        foreach($data as $key => $val) {
            $data[$key]['product'] = &$product[$val['id']];
            $data[$key]['areas']   = &$area[$val['id']];
            $data[$key]['stock_type_format'] = $val['stock_type'] ? '按游戏' : '按分区';
        }
        
        $map = array();
        $product && $map['promotion_id'] = array('in', array_keys($product));
        // $relation = $this->relation->where($map)->select();
        $relation = $this->relation->alias('a')->join('__GOODS__ as gs ON a.pid=gs.id')->field('a.*,gs.status gs_status')->where($map)->select(); //, 'LEFT'
        foreach($relation as $k => $v) {
            $product[$v['promotion_id']][] = $v;
        }
        
        $where = array();
        $area && $where['promotion_id'] = array('in', array_keys($area));
        $stock = $this->stock->where($where)->select();
        foreach($stock as $kk => $vv) {
            $area[$vv['promotion_id']][$vv['aid']] = $vv;
        }
        
        $data = $this->dataFormat($data);
        return $data['_key_'] ?: $data;
    }
}
