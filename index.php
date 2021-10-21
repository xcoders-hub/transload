<?php
error_reporting(E_ALL);
session_start();
include "../system/aes.php";
include "../system/function.php";
include "../system/resumable-download.php";
//include "../system/view/header.php";
include '../system/dl.php';
if(empty($_GET['nm'])){
  header("Location: /") ;
}
if (isset($_COOKIE['crypt'])) {
    $_SESSION['email'] = AES("decrypt", $_COOKIE['crypt']);
}
$id= skycodes_hash_matxrix($_GET['id'], 'd');
$share = json_decode(file_get_contents("../base/data/main/share/$id.json"), true);
$users = json_decode(file_get_contents("../base/data/user/".$share['file']['user_id'].".json"), true);
$formatv = explode("/", $share['file']['mime']);
$formatv = $formatv['0'];
$_GET['s'] = $share['file']['title'];
if (isset($_SESSION['email'])) {
    $ses = json_decode(file_get_contents("../base/data/user/".$_SESSION['email'].".json"), true);
    $ses = $ses['role'];
} else {
    $ses = null;
}
if($_GET['nm']){
    $new_file_name= base64_decode($_GET['nm']);
    $finalfilename= $id.'-'.$new_file_name;
    if(file_exists($finalfilename)){
     header("Location:  $finalfilename");
    }else{
    $fileurl= base64_decode($_GET['gd']);
    start($fileurl, $finalfilename, 10);
    sleep(6);
    // $file = '/transload/'.$finalfilename;
    // set_time_limit(0);
    // $download = new ResumeDownload($file, 5000); //delay about in microsecs 
    // $download->process();
     session_start();
     $_SESSION['oscid'] = $finalfilename;
     $_SESSION['oscgd'] = $fileurl;
     $id = $_SESSION['did'];
     $str = ['.mkv','.zip','.mp4','.rar','-','.'];
     $rplc =['','','','','',''];
        header("Location:  /cdn/".str_replace($str, $rplc , $new_file_name));
        }
}    
?>
