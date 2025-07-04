<?php
if (!function_exists('reDirect')) {
    function reDirect($url, $msg, $msgType) {
        $_SESSION['msg'] = $msg;
        $_SESSION['msgType'] = $msgType;
        header('Location: ' . $url);
        exit(); 
    }
}
?>
