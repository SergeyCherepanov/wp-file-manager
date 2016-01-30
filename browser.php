<?php
/**
 * File Manager - Wordpress Plugin.
 *
 * @copyright:    Copyright 2009 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @author:       Sergey Cherepanov (sergey@cherepanov.org.ua)
 * @license:      http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 * @date          29.09.09
 */

include_once('init.php');
if (isset($_FILES['Filedata'])) {
    include_once('upload.core.php');
}
$dirname = $fm->wd.(isset($_REQUEST['goto']) ? $_REQUEST['goto'] : '');
if (isset($_REQUEST['act'])) {
    switch ($_REQUEST['act']) {
        case 'delete':
            $fm->unlink($_REQUEST['item']);
            break;
        case 'mkdir':
            $fm->mkdir($_REQUEST['dirname']);
            break;
    }
    $dirname = $fm->wd;
}
$files = $fm->readdir($dirname);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="css/main.css" />
<title>Browser</title>
<script type="text/javascript" src="js/common.js"></script>
<script type="text/javascript">
    window.onload = function(){
        var filelist = document.forms.filelist;
        if(filelist){
            var elements = filelist.getElementsByTagName('li');
                for(var i = 0; i < elements.length;i++){
                if(elements[i].className.search('file') != -1)
                    elements[i].onclick = select;
            }
        }
    <?php if(isset($_REQUEST['filename'])):?>
        select(document.getElementById("<?php echo str_replace(' ', '_', $_REQUEST['filename'])?>"));
        top.frames['info'].location.href = 'info.php?info=/<?php echo $_REQUEST['filename'] ?>';
    <?php endif;?>
    }
</script>
</head>
<body class="browser">
    <h2><span class="r"><span class="l"><?php echo $fm->localpath;?></span></span></h2>
    <ul>
        <li class="header">
            <span class="name">Name</span>
            <span class="size">Size</span>
            <span class="actions"><input type="checkbox" value="" onchange="selectall('filelist')" /></span>
        </li>
    </ul>
    <form action="" method="post" name="filelist" id="filelist">
    <input type="hidden" name="act" />
    <ul class="list">
    <?php foreach($files as $file):?>
        <?php if($file['name'] == '..'):?>
            <li class="up"><a class="name" href="?goto=..">..</a></li>
        <?php elseif($file['name'] != '.' && $file['name'] != '..'):?>
            <li class="<?php echo $file['type'].' '.@$file['filetype'];?>" id="<?php echo $file['id']?>">
                <a target="<?php echo ($file['type'] == 'dir' ? '_self' : 'info');?>" class="name" href="<?php echo ($file['type'] == 'dir' ? '?goto' : 'info.php?info');?>=<?php echo $file['path']?>"><?php echo $file['name']?></a>
                <span class="size"><?php echo $file['size']?></span>
                <span class="actions">
                    <input type="checkbox" name="item[]" value="<?php echo $file['path'];?>" />
                       <a href="?act=delete&amp;item=<?php echo $file['path'];?>" onclick="return confirm('Delete item?')"><img src="images/delete.gif" alt="Delete" /></a>
                   </span>
            </li>
        <?php endif;?>
    <?php endforeach;?>
    </ul>
    </form>
</body>
</html>
