<?php
include_once '_lib/func.php';

// echo '<pre>';
// dump($_REQUEST);
// dump($_GET);
dump($_POST);
// dump($_FILES);
die;


// define('FORMDATA',TRUE);
/*if ((bool)ini_get('safe_mode') == true) {
    ini_set('safe_mode','Off');
}
if ((bool)get_magic_quotes_runtime() == true) {
    ini_set('magic_quotes_runtime','Off');
}*/

/*
public function k_input($_r) {
    if (! get_magic_quotes_gpc()) {
        return kekezu::k_addslashes ( $_r );
    } else {
        return $_r;
    }
}
function k_addslashes($string) {
    if (is_array( $string )) {
        $key = array_keys( $string );
        $s = sizeof ( $key );
        for($i = 0; $i < $s; $i ++) {
            $string [$key [$i]] = k_addslashes ( $string [$key [$i]] );
        }
    } else {
        $string = addslashes ( self::escape( trim( $string ) ) );
    }
    return $string;
}

开启 $_REQUEST
$_R = $_REQUEST;
$_R = kekezu::k_input ( $_R );
$_GET   = kekezu::k_input($_GET);
$_POST  = kekezu::k_input($_POST);
$_R and extract ( $_R, EXTR_SKIP );
*/

// echo "<pre>";
// print_r($_REQUEST);die;



$formhash = isset($_POST['formhash'])?$_POST['formhash']:'';
$btn_act = isset($_POST['btn_act'])?$_POST['btn_act']:'';
// echo $_GET['mod'];// GET无值
// echo $_POST['mod'];

if ($formhash&&$btn_act) {
    $_POST['fields'] = array_filter($_POST['fields']);
    $_POST = array_filter($_POST);
    echo "<pre>";
    // print_r($_POST);
    echo "<br>";
    // print_r($_FILES);
    $n = sizeof($_FILES['attachfiles']['name']);
    echo $n;
    // for ($i=0; $i <= $n; $i++) { 
    //     $
    // }
} else {
	session_start();
	// print_r($_SESSION);
	unset($_SESSION['sid']);
	session_unset();
	session_destroy();
	// print_r($_SESSION);
}

?>