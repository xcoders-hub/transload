<?php
session_start();
$file = $_SESSION['oscid'];
$id = $_SESSION['did'];
$streamurl= $_SESSION['oscgd'];
include "../system/resumable-download.php";
include "../system/aes.php";
include "../system/function.php";
if(isset($_COOKIE['crypt'])){ $_SESSION['email'] = AES("decrypt",$_COOKIE['crypt']); }
$share = json_decode(file_get_contents('../base/data/main/share/'.$id.'.json'), true);
$users = json_decode(file_get_contents("../base/data/user/".$share['file']['user_id'].".json"),true);
$formatv = explode("/",$share['file']['mime']);
$formatv = $formatv['0'];
$_GET['s'] = $share['file']['title'];
if(isset($_SESSION['email'])){
$ses = json_decode(file_get_contents("../base/data/user/".$_SESSION['email'].".json"),true);
$ses = $ses['role'];
} else {
$ses = null;
}
include "../system/view/header.php";
if(isset($_POST['ddl'])){
    set_time_limit(0);
    $download = new ResumeDownload($file); //delay about in microsecs 
    $download->process($file);
}
?>
<script>
if(document.referrer.indexOf('driveup.in') >= 0){ document.getElementById("Dmcaprotect").innerHTML }else{ window.location.href = 'https://driveup.in/';}
</script>
<div class="row justify-content-center">
<div class="col-lg-9 col-md-9 mb-4">
<div class="card shadow mb-4 text-light">
<div class="card-header py-3">
<h5 class="m-0 font-weight-bold text-light" align="center"><i class="fa fa-cog fa-spin fa-fw"></i>Download Link Generated !!</h5>
</div>
<div align="center" class="card-body">
<h6 class="m-0 font-weight-bold text-light" align="center"><?php echo $share['file']['title']?></h6><br>
<form action="" method="post">
<button type="submit" name="ddl" class="btn btn-outline-success btn-user font-weight-bold"><i class="fas fa-cloud-download-alt"></i> Download Here <?php echo formatBytes($share['file']['size'])?></button>
</form>
<br>
<br>
<hr>
<? if($users['web_player'] == 'yes' && $share['file']['mime'] == "video/x-matroska" || $share['file']['mime'] == "video/mp4"):?>
<a class="btn btn-outline-light btn-user font-weight-bold" href="/splay.php?id=<?php echo skycodes_hash_matxrix($id, 'e')?>&code=200&gd=<?= skycodes_hash_matxrix($streamurl, 'e');?>" target="_blank"><i class="fas fa-video"></i> Play/Stream Video</a>
<? endif;?>
<br>
<script async src="https://securepubads.g.doubleclick.net/tag/js/gpt.js"></script>
<script>
  window.googletag = window.googletag || {cmd: []};
  googletag.cmd.push(function() {
    googletag.defineSlot('/21903444296/quadplay_sidebar', [300, 250], 'div-gpt-ad-1625680216260-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
  });
</script>
<!-- /21903444296/quadplay_sidebar -->
<div id='div-gpt-ad-1625680216260-0' style='min-width: 300px; min-height: 250px;'>
  <script>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1625680216260-0'); });
  </script>
</div>