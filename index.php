<?php
error_reporting(E_ALL);
session_start();
include "resumable-download.php";
include 'dl.php';
if($_GET['gd']){
    $new_file_name= 'movie.mkv');
    $finalfilename= $new_file_name;
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
