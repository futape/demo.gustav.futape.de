<?php
/*-----BEGIN GV BLOCK-----
_title: Blog
_desc: Blog entries by Lucas Krause on futape.de.
_dest: {{$dest_dir}}
_conv: html
_dyn
-----END GV BLOCK-----*/

require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "gustav", "src", "futape", "gustav", "GustavBase.php"));
require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "gustav", "src", "futape", "gustav", "Gustav.php"));
require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "gustav", "src", "futape", "gustav", "GustavSrc.php"));

use futape\gustav\GustavBaseHooks;
use futape\gustav\Gustav;
use futape\gustav\GustavSrc; ?>

<h1>Blog</h1><?php

foreach(Gustav::query() as $val){
    try {
        $src_a=new GustavSrc($val);
    } catch(Exception $e){
        continue;
    } ?>
    
    <h3><a href="<?php echo GustavBaseHooks::escapeHtml(GustavBaseHooks::path2url($src_a->getBlock("_dest"), false)); ?>"><?php echo GustavBaseHooks::escapeHtml(!is_null($src_a->getBlock("_title")) ? $src_a->getBlock("_title") : basename($src_a->getBlock("_dest"))); ?></a></h3><?php
    if(!is_null($src_a->getBlock("_pub"))){ ?>
        <p class="subtitle"><?php echo date("j.n.Y H:i", $src_a->getBlock("_pub")); ?></p><?php
    }
} ?>
