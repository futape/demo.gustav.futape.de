<?php
/*-----BEGIN GV BLOCK-----
_title: Categories
_desc: A map of blog categories.
_dest: /categories/
_conv: html
_dyn
-----END GV BLOCK-----*/

require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "futape", "gustav", "GustavBase.php"));
require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "futape", "gustav", "Gustav.php"));

use futape\gustav\GustavBaseHooks;
use futape\gustav\Gustav; ?>

<h1>Categories</h1><?php

$fn_a=function($arr_a) use (&$fn_a){
    if(count($arr_a)>0){ ?>
        <ul><?php
            foreach($arr_a as $key=>$val){
                echo '<li><a href="/search/?term=&amp;cat='.urlencode($key).'">'.($val["root"] ? "Blog" : GustavBaseHooks::escapeHtml($val["name"])).'</a> ('.$val["count"].')';
                
                $fn_a($val["sub"]);
                
                echo '</li>';
            } ?>
        </ul><?php
    }
};

$fn_a(Gustav::getCategories()); ?>