<?php
/*-----BEGIN GV BLOCK-----
_title: Search
_desc: Search the blog.
_dest: /search/
_conv: html
_dyn
-----END GV BLOCK-----*/

require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "gustav", "src", "futape", "gustav", "GustavBase.php"));
require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "gustav", "src", "futape", "gustav", "Gustav.php"));

use futape\gustav\GustavBase;
use futape\gustav\GustavBaseHooks;
use futape\gustav\Gustav; ?>

<h1>Search</h1>

<form>
    <p><input type="text" name="term" value="<?php echo GustavBaseHooks::escapeHtml((string)(@$_GET["term"])); ?>" placeholder="Searchterm" /></p>
    
    <p>
        <input type="checkbox" name="search_title" id="search-title"<?php echo (!array_key_exists("term", $_GET) || array_key_exists("search_title", $_GET)) ? ' checked' : ""; ?> /> <label for="search-title">Title</label>&nbsp; &nbsp;
        <input type="checkbox" name="search_tags" id="search-tags"<?php echo (!array_key_exists("term", $_GET) || array_key_exists("search_tags", $_GET)) ? ' checked' : ""; ?> /> <label for="search-tags">Tags</label>&nbsp; &nbsp;
        <input type="checkbox" name="search_file" id="search-file"<?php echo (!array_key_exists("term", $_GET) || array_key_exists("search_file", $_GET)) ? ' checked' : ""; ?> /> <label for="search-file">Filename</label>
    </p>
    
    <h4>Category</h4>
    <p>
        <input type="radio" name="cat" id="cat- " value=" "<?php echo (!array_key_exists("cat", $_GET) || $_GET["cat"]==" ") ? ' checked' : ""; ?>> <label for="cat- ">All categories</label>
    </p><?php
        
    $fn_a=function($arr_a) use (&$fn_a){
        if(count($arr_a)>0){ ?>
            <ul style="list-style:none;"><?php
                foreach($arr_a as $key=>$val){
                    $str_id=GustavBaseHooks::escapeHtml("cat-".$key);
                    
                    echo '<li><input type="radio" name="cat" id="'.$str_id.'" value="'.GustavBaseHooks::escapeHtml($key).'"'.((array_key_exists("cat", $_GET) && (GustavBaseHooks::stripPath($_GET["cat"], $key)==DIRECTORY_SEPARATOR || GustavBaseHooks::stripPath($key, $_GET["cat"])==DIRECTORY_SEPARATOR)) ? ' checked' : "").'> <label for="'.$str_id.'">'.($val["root"] ? "Blog" : GustavBaseHooks::escapeHtml($val["name"])).'</label>';
                    
                    $fn_a($val["sub"]);
                    
                    echo '</li>';
                } ?>
            </ul><?php
        }
    };

    $fn_a(Gustav::getCategories()); ?>
    
    <p><button type="submit">Search</button></p>
</form><?php

if(array_key_exists("term", $_GET)){
    $arr_term=$_GET["term"];
    $str_dir=array_key_exists("cat", $_GET) ? $_GET["cat"] : " ";
    
    if($str_dir==" "){
        $str_dir="";
        $q_recursive=true;
    }else{
        $str_dir=GustavBaseHooks::stripPath(GustavBaseHooks::url2path($str_dir), array($_SERVER["DOCUMENT_ROOT"], Gustav::getConf(Gustav::CONF_DEST_DIR)));
        $q_recursive=false;
    }
    
    $int_members=0;
    
    if(array_key_exists("search_title", $_GET)){
        $int_members|=Gustav::SEARCH_TITLE;
    }
    if(array_key_exists("search_tags", $_GET)){
        $int_members|=Gustav::SEARCH_TAGS;
    }
    if(array_key_exists("search_file", $_GET)){
        $int_members|=Gustav::SEARCH_FILE;
    }
    
    $arr_matches=Gustav::search($arr_term, $str_dir, $q_recursive, $int_members);
    
    foreach($arr_matches as $match_a){
        $arr_highlight=$match_a->getHighlight();
        $src_a=$match_a->getSrc(); ?>
        
        <p><?php
            echo '<a href="'.GustavBaseHooks::escapeHtml(GustavBaseHooks::path2url($src_a->getBlock("_dest"), false)).'">';
            
            if(array_key_exists(GustavBase::KEY_TITLE, $arr_highlight)){
                echo $arr_highlight[GustavBase::KEY_TITLE];
                echo '</a><br /><span class="subtitle">';
            }
            
            echo $arr_highlight[GustavBase::KEY_FILE];
            
            echo '</'.(array_key_exists(GustavBase::KEY_TITLE, $arr_highlight) ? "span" : "a").'>';
            
            echo '<br />'.GustavBaseHooks::escapeHtml($src_a->getDesc());
            
            if(count($arr_highlight[GustavBase::KEY_TAGS])>0){
                echo '<br />'.implode(", ", $arr_highlight[GustavBase::KEY_TAGS]);
            }
            
            if(!is_null($src_a->getBlock("_pub"))){
                echo '<br />'.date("j.n.Y H:i", $src_a->getBlock("_pub"));
            } ?>
        </p><?php
    }
} ?>
