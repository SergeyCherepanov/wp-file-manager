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
include_once('image.lib.php');
$image = new Image($fm->wd.$_REQUEST['file']);
$image->resize(200, 150, 'alpha')->display('png');
