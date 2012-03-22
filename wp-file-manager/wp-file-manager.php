<?php
/*
Plugin Name: File Manager
Plugin URI:  http://www.wp-admin.org.ua
Description: Provides interface for manage your files on the server.
Author: Sergey Cherepanov
Author URI:  http://www.cherepanov.org.ua
Version: 1.3
*/

/**
 * File Manager - Wordpress Plugin.
 *
 * @copyright:    Copyright 2009 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @author:       Sergey Cherepanov (sergey@cherepanov.org.ua)
 * @license:      http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 * @date          29.09.09
 */

function file_manager_insert_script()
{
    ?>
    <script type="text/javascript">
        function file_manager(id){
            window.open('<?php echo get_option("siteurl")?>/wp-content/plugins/wp-file-manager/index.php?id=' + id + '&user_ID=<?php echo $user_ID?>', '_blank', 'border=0, resizable=0, scrollbars=0, menubar=0,width=680,height=500, left=' + (screen.width - 570)/2 + ',top=' + (screen.height - 805 )/2);
            return false;
        }
    </script>
    <?php
}

function fm_button($id)
{
    $html = '';
    if(current_user_can('upload_files')){
        $html = '<input type="button" onclick="window.open(\''.get_option("siteurl").'/wp-content/plugins/wp-file-manager/index.php?id='.$id.'\', \'_blank\', \'border=0, resizable=0, scrollbars=0, menubar=0,width=680,height=500, left=\' + (screen.width - 570)/2 + \',top=\' + (screen.height - 805 )/2);" class="button btn" value="Choose file..."/>';
    }
    return $html;
}
