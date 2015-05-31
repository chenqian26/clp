<?php
/*
  +----------------------------------------------------------------------+
  | Powered by chenqian26                                                |
  +----------------------------------------------------------------------+
  | download_index.php 2015/05/23 23:29:53 CST chenqian26      |
  +----------------------------------------------------------------------+
*/
$path = getgpc('path');
$dir = DISCUZ_ROOT.'ftp/resource/';

if($path)
{
    $dir=$dir.$path.'/';
}

$data['dir'] ='';
$data['file'] = '';
$data['cur_path'] = $path.'/';

$temp = explode("/",$data['cur_path']);
array_pop($temp);
array_pop($temp);
$data['up_path'] = implode("/",$temp);

if (is_dir($dir)) 
{
    if ($dh = opendir($dir))
    {
        while (($file = readdir($dh)) !== false)
        {
            if(filetype($dir . $file) == 'dir' && $file!='.' && $file!='..')
                $data['dir'][] = $file;
            elseif(filetype($dir . $file) == 'file')
                $data['file'][] = $file;
        }
        closedir($dh);
    }
}

else
{
showmessage("文件目录不存在","download.php",$values=array(),array('timeout'=>true,'refreshtime'=>4));
}

include template('diy:download/index');
?>
