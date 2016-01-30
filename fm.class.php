<?php
/**
 * File Manager - Wordpress Plugin.
 *
 * @copyright:    Copyright 2009 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @author:       Sergey Cherepanov (sergey@cherepanov.org.ua)
 * @license:      http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 * @date          29.09.09
 */

class filemanager
{
    public function __construct()
    {
        include_once(dirname(__FILE__).'/fm.config.php');
        $this->root                = isset($fm_conf['wd']) ? $fm_conf['wd'] : '.';
        $this->root_protection    = isset($fm_conf['root_protection']) ? $fm_conf['root_protection'] : true;
        $this->http_prefix        = isset($fm_conf['http_prefix']) ? $fm_conf['http_prefix'] : '';
        $this->wd                = (string) ( @$_SESSION['wd'] ? $_SESSION['wd'] : $this->root );
        $this->localpath        = str_replace($this->root, '', $this->wd);
        $this->errors            = array();
    }
    public function readdir($dirname = false)
    {
        if ($this->wd.'..' == $dirname) {
            $dirname = preg_replace('/(\/?[^\/]*)$/', '', $dirname);
        }
        if (!$dirname || !($dir = opendir($dirname))) {
            return false;
        } else {
            $_SESSION['wd']        = $dirname;
            $this->localpath    = str_replace($this->root, '', $dirname);
        }
        $files = Array();
        $dirs  = Array();

        while ($file = readdir($dir)) {
            $name = $file;
            $path = '/'.$file;
            if ($name != '.'):
                if ($name != '..') {
                    if (is_dir($dirname.'/'.$file)) {
                        $dirs[] = array('name' => $name, 'id'=>str_replace(' ', '_', $name), 'type' => 'dir', 'path'=>$path);
                    } else{
                        $files[] = array('name' => $file, 'id'=>str_replace(' ', '_', $name), 'type' => 'file', 'filetype'=>strtolower(preg_replace('/.*?\./', '', $name)), 'path'=>$path, 'size'=>filesize($dirname.$path));
                    }
                } else if (!$this->root_protection && $dirname == $this->root) {
                    array_unshift($dirs, array(
                        'name' => $name,
                        'type' => 'dir',
                        'path' => $path
                    ));
                } else if($dirname != $this->root) {
                    array_unshift($dirs, array(
                        'name' => $name,
                        'type' => 'dir',
                        'path' => $path
                    ));
                }
            endif;
        }
        closedir($dir);
        return array_merge($dirs, $files);
    }
    public function rmdir($dirname)
    {
        if (!is_dir($dirname) || !($dir = opendir($dirname))) {
            return false;
        }
        while ($file  =  readdir($dir)) {
            if ($file  !=  "."  &&  $file  !=  "..")  {
                if (is_file($dirname.'/'.$file)){
                    unlink($dirname.'/'.$file);
                } else{
                    $this->rmdir($dirname.'/'.$file);
                }
            }
        }
        closedir($dir);
        @rmdir($wd.$dirname);
        return true;
    }
    public function unlink($data)
    {
        if (is_array($data)) {
            foreach ($data as $file) {
                $file = $this->wd.$file;
                if (is_file($file)) {
                    unlink($file);
                } else if(is_dir($file)) {
                    $this->rmdir($file);
                }
            }
        } elseif ($data) {
            $file = $this->wd.$data;
            if (is_file($file)) {
                unlink($file);
            } elseif (is_dir($file)) {
                $this->rmdir($file);
            }
        }
    }
    public function mkdir($name)
    {
        if (!file_exists($this->wd.$name)) {
            mkdir($this->wd.$name, 0777);
        } else {
            array_push($this->errors, 'Derictory [ <strong>' . $name . '</strong> ] already exists!');
        }
    }
}
