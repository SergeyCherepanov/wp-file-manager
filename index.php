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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File manager</title>
<link type="text/css" rel="stylesheet" href="css/main.css" />
<script type="text/javascript">
    var is_tinymce    = false;
    var request_id    = "<?php echo $_REQUEST['id'];?>";
    var http_prefix   = "<?php echo $fm->http_prefix;?>";
    var baseurl       = "<?php echo $uploaddir['baseurl'];?>";
</script>
<?php if(isset($_REQUEST['tinymce'])):?>
    <script type="text/javascript"> var is_tinymce = true;</script>
    <script type="text/javascript" src="js/for_tinymce.js"></script>
<?php endif;?>
<script type="text/javascript" src="js/common.js"></script>
</head>
<body class="main">
    <div id="page">
        <div class="lcol">
            <iframe src="browser.php" name="browser" id="browser" frameborder="0" ></iframe>
            <div class="bottombg">&nbsp;</div>
        </div>
        <div class="rcol">
            <div class="frame actions">
                <h2><span class="r"><span class="l">Actions</span></span></h2>
                <ul>
                    <li class="deleteall"><a href="#DeleteSelected" onclick="deleteSelected();return false">Delete selected</a></li>
                    <li class="addnew"><a href="#mkdir" target="browser" onclick="mkdir();return false">Add new folder</a></li>
                    <li class="upload"><a href="upload.php" target="browser">Upload file</a></li>
                </ul>
            <div class="bottombg">&nbsp;</div>
            </div>
            <iframe src="info.php" name="info" id="info" frameborder="0" ></iframe>
            <div class="info bottombg">&nbsp;</div>
            <div class="btns">
                <h2><span class="r"><span class="l">&nbsp;</span></span></h2>
                <input type="image" name="cancel" src="images/cancel.png" alt="Cancel" onclick="window.close()" />
                <input type="image" name="ok" src="images/ok.png" alt="Ok" onclick="returnUrl()"/>
            </div>
            <div class="btns bottombg">&nbsp;</div>
        </div>
    </div>
    <div id="lightbox">
        &nbsp;
    </div>
    <iframe frameborder="0" src="#" id="uploadform" name="uploadform"></iframe>
</body>
</html>
