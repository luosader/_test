<?php
header('Content-Type: text/html; charset=UTF-8');
$num1  = $_POST['num1'];
$num2  = $_POST['num2'];
$fuhao = $_POST['fuhao'];

switch ($fuhao) {
    case '+':$fuhao = '1';
        break;
    case '-':$fuhao = '2';
        break;
    case '×':$fuhao = '3';
        break;
    case '÷':$fuhao = '4';
        break;
    default:$fuhao = '1';
}
//var_dump($fuhao);die;
if ($fuhao == '1') {
    echo $num1 + $num2;
} elseif ($fuhao == '2') {
    echo $num1 - $num2;
} elseif ($fuhao == '3') {
    echo $num1 * $num2;
} elseif ($fuhao == '4') {
    echo $num1 / $num2;
} else {
    echo $num1 % $num2;
}
