<?php
require_once 'chinese.php';

/**
 * 测试
 */
class Nameless
{
    public function __construct()
    {
        $this->moralDefault = '不可描述';
        $this->moral = array('亲密无间', '永远和你在一起', '水火不相容', '知心朋友', '心上人', '帮你做事的人', '帮你的人', '面和心不合', '男女关系不正常', '情投意合', '关系马虎', '尊敬你的人', '爱你的人', '适合你的', '说你坏话的人', '克星', '救星', '忠心的人', '狼心狗肺的人', '单相思', '山盟海誓', '情敌', '服从你的人', '永远在一起', '伴终生', '恨你又爱你');
    }

    /**
     * 计算两个姓名的笔画差
     */
    public function nameDiff($name1, $name2)
    {
        $bihua = new Bihua();
        $result1  = $bihua->stat($name1);
        $result2  = $bihua->stat($name2);

        return abs($result1['bihua'] - $result2['bihua']);
    }

    // 获取对应寓意
    public function out($name1, $name2)
    {
        $diff = $this->nameDiff($name1, $name2);

        return isset($this->moral[$diff]) ? $this->moral[$diff] : $this->moralDefault;
    }
}


$less = new Nameless;
// var_dump($less->moral);
$name1 = '克星';
$name2 = '救星一爱的二维';

$nana = $less->out($name1, $name2);
var_dump($nana);
