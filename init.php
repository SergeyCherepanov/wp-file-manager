<?php
/**
 * File Manager - Wordpress Plugin.
 *
 * @copyright:    Copyright 2009 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @author:       Sergey Cherepanov (sergey@cherepanov.org.ua)
 * @license:      http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 * @date          29.09.09
 */

$wpconfig = realpath("../../../wp-config.php");
if (!file_exists($wpconfig))  {
    echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ;
    die;
}// stop when wp-config is not there

require_once($wpconfig);

if(!isset($_FILES['Filedata'])){
    require_once(ABSPATH.'/wp-admin/admin.php');
}
session_start();
require_once('fm.class.php');
$fm = new filemanager();
