<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | download.php 2015/05/19 23:32:55 CST chenqian26      |
  +----------------------------------------------------------------------+
 */
$download_root = './ftp/resource/';

$file_path = $download_root.$_GET['filename'];
if(!file_exists($file_path))
{
    echo "file not exists"."<br>";
    //echo $file_path;
    exit;
}


header("Content-type: application/octet-stream");

//处理中文文件名

$ua = $_SERVER["HTTP_USER_AGENT"];

//$file_name = end(explode("/",$file_path));
$file_name = basename($file_path);
$encoded_filename = urlencode($_GET['filename']);

$encoded_filename = str_replace("+", "%20", $encoded_filename);

if (preg_match("/MSIE/", $ua))
    {
header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
    } 
else if (preg_match("/Firefox/", $ua))
    {

header("Content-Disposition: attachment; filename*=\"utf8''" . $file_name . '"');

    }
else
    {
header('Content-Disposition: attachment; filename="' . $file_name . '"');
    }

////让Xsendfile发送文件
//  header("X-Sendfile: $_GET['filename']");
readfile($file_path);

?>
