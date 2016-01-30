<?php
/**
 * File Manager - Wordpress Plugin.
 *
 * @copyright:    Copyright 2009 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @author:       Sergey Cherepanov (sergey@cherepanov.org.ua)
 * @license:      http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 * @date          29.09.09
 */

$uploaddir = wp_upload_dir();
$fm_conf['wd'] = $uploaddir['basedir'];
$fm_conf['http_prefix'] = '';//str_replace(get_bloginfo('siteurl').'/', '', $uploaddir['baseurl']);
$fm_conf['root_protection'] = true;
