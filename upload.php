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

if (isset($_FILES['Filedata']['name'])) {
    if (isset($_REQUEST['destination'])) {
        $uploadDir = $_REQUEST['destination'] . '/';
    } else {
        $uploadDir = './';
    }
    $uploaded_file = $uploadDir . $_FILES['Filedata']['name'];
    move_uploaded_file ($_FILES['Filedata']['tmp_name'], $uploaded_file);
    chmod ($uploaded_file, 0777);

    header('Location: browser.php');
    exit();
}

$maxfilesize = ini_get('upload_max_filesize') > ini_get('post_max_size') ? ini_get('post_max_size') : ini_get('upload_max_filesize');
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload file</title>
<script type="text/javascript" src="js/common.js"></script>
<link type="text/css" rel="stylesheet" href="css/main.css" />
</head>
<body class="browser">
    <h2>
        <span class="r">
            <span class="l">Upload file</span>
            <a href="browser.php" style="display:block;float:right;margin: 4px 4px 0 0;_margin: 4px 2px 0 0">
                <img src="images/close.gif" alt="close" />
            </a>
        </span>
    </h2>
    <div class="upload-block">
        <p>Max file size: <?php echo $maxfilesize;?></p>
        <br/>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="destination" value="<?php echo $fm->wd;?>" />
            <input type="file" name="Filedata" />
            <input type="submit" value="upload"/>
        </form>
    </div>
</body>
</html>
