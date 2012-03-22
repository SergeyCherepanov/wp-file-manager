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
$file = $_REQUEST['info'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Info</title>
<link type="text/css" rel="stylesheet" href="css/main.css" />
</head>
<body class="preview">
    <h2><span class="r"><span class="l"><?php isset($file) ? print $file : print '&nbsp;';?></span></span></h2>
    <div id="info-box">
<?php
if ($file):
    if (preg_match("/\.jpg$/i", $file)
        || preg_match("/\.gif$/i", $file)
        || preg_match("/\.png$/i", $file)) {
        $file_info = getimagesize($fm->wd.$file);
    ?>
        <div style="height:150px;overflow:hidden;">
            <img width="200" src="image.php?file=<?php echo preg_replace('/\s/im', '%20', $file);?>" alt=""/>
        </div>
        <p><?php echo $file_info[0]?>&nbsp;x&nbsp;<?=$file_info[1]?>&nbsp;px</p>
        <br/>
        <p>Size: <?php echo round((filesize($fm->wd.$file) / 1024), 2);?> KB</p><?
    } else {?>
        <h4><?php echo str_replace('/', '', $file);?>&nbsp;</h4>
        <br/>
        <p>Size: <?php echo round((filesize($fm->wd.$file) / 1024), 2);?> KB </p><?
    }
endif;?>
    <form name="object" method="post" action="">
        <input type="hidden" name="url" value="<?php echo str_replace($fm->root, '', $fm->wd).$file;?>" />
    </form>
</div>
</body>
</html>
