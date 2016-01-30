/**
 * File Manager - Wordpress Plugin.
 *
 * @copyright:    Copyright 2009 Sergey Cherepanov. (http://www.cherepanov.org.ua)
 * @author:       Sergey Cherepanov (sergey@cherepanov.org.ua)
 * @license:      http://www.gnu.org/licenses/gpl.html GNU GENERAL PUBLIC LICENSE v3.0
 * @date          29.09.09
 */

function mkdir(){
    if($dirname = prompt('Please type dirname')){
        window.frames['browser'].location.href='browser.php?act=mkdir&dirname=/' + $dirname;
    }
    return false;
}
function deleteSelected(){
    if(confirm('Delete selected items ?')){
        window.frames['browser'].document.forms.filelist.act.value = "delete";
        window.frames['browser'].document.forms.filelist.submit();
    }
    return false;
}
function returnUrl(){
    var url = frames['info'].document.forms['object'].url.value;
    if(url){
        try{
            eval('window.opener.'+request_id+'("'+http_prefix + url+'")');
        }catch(e){
            if(is_tinymce){
                selectFile(baseurl + url);
            }else{
                window.opener.document.getElementById(request_id).value = http_prefix + url;
            }
        }
        window.close();
    }
}
function select(elem){
        if(elem.nodeType == 1)
            var element = elem;
        else if(this.nodeType == 1)
            var element = this;
    try {
        element.className += " selected ";
    } catch(e){
        null;
    }
    try{
        current.className = current.className.replace(/selected/, "");
    }catch(e){
        null;
    }
    current = element;
}
function selectall($form){
    $inputs = document.forms[$form].getElementsByTagName('input');
    for(var $key in $inputs){
        if($inputs[$key].type == 'checkbox'){
            if($inputs[$key].checked)
                $inputs[$key].checked = false;
            else
                $inputs[$key].checked = true;
        }

    }
}
