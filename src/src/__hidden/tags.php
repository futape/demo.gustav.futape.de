<?php
/*-----BEGIN GV BLOCK-----
_title: Tags
_desc: A list of blog tags.
_dest: /tags/
_conv: html
_dyn
-----END GV BLOCK-----*/

require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "futape", "gustav", "GustavBase.php"));
require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "futape", "gustav", "Gustav.php"));

use futape\gustav\GustavBaseHooks;
use futape\gustav\Gustav; ?>

<h1>Tags</h1><?php

$arr_tags=Gustav::getTags();

if(count($arr_tags)>0){ ?>
    <ul><?php
        foreach(Gustav::getTags() as $key=>$val){
             echo '<li><a href="/search/?search_tags=1&amp;term='.urlencode($key).'">'.GustavBaseHooks::escapeHtml($key).'</a> ('.$val.')</li>';
        } ?>
    </ul><?php
} ?>