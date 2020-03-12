<?php
echo '<pre>';
$a = json_decode('{"data":[{"ProjectNo":"1000000","ProjectName":"\u3010\u7F51\u8D37\u4F53\u9A8C\u3011\u7528\u4E8E\u4E2A\u4EBA\u6D88\u8D39\u4F53\u9A8C"},{"ProjectNo":"999999","ProjectName":"\u3010\u5B9E\u4F53\u7ECF\u8425\u3011\u4E8C\u6B21\u501F\u6B3E\uFF0C\u5229\u7528\u591A\u4F59\u7684\u65F6\u95F4\u521B\u4E1A\uFF0C\u8BF7\u5927\u5BB6\u5E2E\u52A9"},{"ProjectNo":"999998","ProjectName":"\u3010\u5B9E\u4F53\u7ECF\u8425\u3011\u5546\u7528\u8D44\u91D1\u3001\u8D27\u7269\u6D41\u8F6C\u3001\u4E2A\u4F53\u5B9E\u4F53\u5E97\u7ECF\u8425"},{"ProjectNo":"999997","ProjectName":"\u3010\u4E2A\u4EBA\u6D88\u8D39\u3011\u4E2A\u4EBA\u5E94\u6025\u8FD8\u671B\u6709\u5144\u5F1F\u53EF\u4EE5\u5148\u6551\u6551\u6025\u5341\u4E07\u706B\u6025"},{"ProjectNo":"999996","ProjectName":"\u3010\u7D2F\u79EF\u4FE1\u7528\u3011\u8FC7\u51E0\u5929\u51C6\u5907\u56DE\u8001\u5BB6\u4E00\u8D9F\uFF0C\u6240\u4EE5\u501F\u6B3E\uFF0C\u4F46\u4E3B\u8981\u662F\u60F3\u7D2F\u8BA1\u4FE1\u7528\u3002"},{"ProjectNo":"999995","ProjectName":"\u3010\u4E2A\u4EBA\u6D88\u8D39\u3011cyy421125\u7684\u9996\u6B21\u501F\u6B3E\u2014wap\u4E13\u4EAB"},{"ProjectNo":"999994","ProjectName":"\u3010\u4E2A\u4EBA\u6D88\u8D39\u3011\u51C6\u5907\u4E70\u8F86\u4E8C\u624B\u8F66\u5DE5\u7A0B\u4E0A\u7528"},{"ProjectNo":"999993","ProjectName":"\u3010\u5B9E\u4F53\u7ECF\u8425\u3011\u4F5C\u4E3A\u7ECF\u8425\u8D44\u91D1\u5468\u8F6C"},{"ProjectNo":"999992","ProjectName":"\u3010\u5B9E\u4F53\u7ECF\u8425\u3011elive2013\u7684\u7B2C5\u6B21\u501F\u6B3E\uFF0C\u4FE1\u7528\u826F\u597D\uFF0C\u6309\u65F6\u8FD8\u6B3E\u3002"},{"ProjectNo":"999991","ProjectName":"\u7B2C\u4E8C\u6B21\u501F\u6B3E\u4E86\uFF0C\u65E0\u62D6\u6B20\uFF0C\u597D\u4FE1\u8A89\uFF0C\u671F\u671F\u5206\u7EA2\uFF0C\u5E0C\u671B\u5927\u5BB6\u652F\u6301"},{"ProjectNo":"999990","ProjectName":"\u3010\u7D2F\u79EF\u4FE1\u7528\u3011\u79EF\u7D2F\u4FE1\u7528\u5EA6\uFF0C\u4EE5\u540E\u7528\u4E8E\u751F\u610F\u5468\u8F6C"},{"ProjectNo":"999989","ProjectName":"\u3010\u4E2A\u4EBA\u6D88\u8D39\u3011qq799899292\u7684\u9996\u6B21\u501F\u6B3E\u2014wap\u4E13\u4EAB"},{"ProjectNo":"999988","ProjectName":"\u3010\u5B9E\u4F53\u7ECF\u8425\u3011\u9000\u4F0D\u56DE\u5BB6\uFF0C\u521B\u4E1A\u81F4\u5BCC"},{"ProjectNo":"999987","ProjectName":"\u3010\u7F51\u5546\u7ECF\u8425\u3011\u7ECF\u8425\u5B9E\u4F53\u6BCD\u5A74\u73A9\u5177\u5E97&#43;\u6DD8\u5B9D\u5E97\u79EF\u7D2F\u4FE1\u8A89"},{"ProjectNo":"999986","ProjectName":"\u3010\u4E2A\u4EBA\u6D88\u8D39\u3011\u4E3A\u4E86\u65B9\u4FBF\u4E0A\u73ED\u751F\u6D3B\u4E70\u8F66"},{"ProjectNo":"999985","ProjectName":"\u3010\u4E2A\u4EBA\u6D88\u8D39\u3011\u4E0A\u534A\u5E74\u5F00\u9500\u8FC7\u5927\u5BFC\u81F4\u73B0\u5728\u6025\u9700\u94B1\u7528"},{"ProjectNo":"999984","ProjectName":"\u3010\u7F51\u5546\u7ECF\u8425\u3011\u7F51\u7EDC\u7535\u5546\uFF0C\u9500\u552E\u4E2D\u836F\u6750\uFF0C\u4FDD\u5065\u54C1\u4E4B\u7C7B"},{"ProjectNo":"999983","ProjectName":"\u3010\u4E2A\u4EBA\u6D88\u8D39\u3011\u5E94\u5C4A\u6BD5\u4E1A\u751F\u5DE5\u4F5C\u524D\u671F\u4E2A\u4EBA\u6D88\u8D39"},{"ProjectNo":"999982","ProjectName":"\u3010\u5B9E\u4F53\u7ECF\u8425\u3011\u4E2A\u4F53\u7ECF\u5546\u5468\u8F6C\u8D44\u91D1\u4E0D\u5230\u4F4D"},{"ProjectNo":"999981","ProjectName":"\u3010\u4E2A\u4EBA\u6D88\u8D39\u3011\u60F3\u4E70\u90E8\u65B0\u8F66\uFF0C\u8FD8\u5DEE\u51E0\u4E07\u5143\uFF0C\u5E0C\u671B\u5F97\u5230\u5927\u5BB6\u8BA4\u53EF\u3002\u672C\u4EBA\u6536\u5165\u7A33\u5B9A\uFF0C\u8C22\u8C22"}],"msg":"success"}');
// print_r($a);

function obj_arr($data) {
    if(is_object($data)) {
        $data = (array)$data;
    }
    if(is_array($data)) {
        foreach($data as $key=>$value) {
            $data[$key] = obj_arr($value);
        }
    }
    return $data;
}
print_r(obj_arr($a));

// function object_to_array($e) {
//     $e = (array) $e;
//     foreach ($e as $k => $v) {
//         if (gettype($v) == 'resource')
//             return;
//         if (gettype($v) == 'object' || gettype($v) == 'array')
//             $e[$k] = (array) object_to_array($v);
//     }
//     return $e;
// }
// print_r(object_to_array($a));

// function arrayToObject($e) {
//     if (gettype($e) != 'array')
//         return;
//     foreach ($e as $k => $v) {
//         if (gettype($v) == 'array' || getType($v) == 'object')
//             $e[$k] = (object) arrayToObject($v);
//     }
//     return (object) $e;
// }

// 对象转化为数组
function objectToArray($d) {
    if (is_object($d)) {
        $d = get_object_vars($d);
    }
    if (is_array($d)) {
        return array_map(__FUNCTION__, $d);
    } else {
        return $d;
    }
}
// print_r(objectToArray($a));

