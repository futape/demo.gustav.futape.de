<?php
    require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "futape", "gustav", "GustavBase.php"));
    
    use futape\gustav\GustavBaseHooks;
    
?><!doctype html>
<html>
    <head>
        <meta charset="utf-8" /><?php
        if(!is_null($gv["src"]->getBlock("_title"))){ ?>
            <title><?php echo GustavBaseHooks::escapeHtml($gv["src"]->getBlock("_title")); ?></title><?php
        }
        if(count($gv["src"]->getBlock("_tags"))>0){ ?>
            <meta name="keywords" content="<?php echo GustavBaseHooks::escapeHtml(implode(",", $gv["src"]->getBlock("_tags"))); ?>" /><?php
        } ?>
        <meta name="description" content="<?php echo GustavBaseHooks::escapeHtml($gv["src"]->getDesc()); ?>" />
        <link rel="stylesheet" href="/css/normalize.css" />
        <link rel="stylesheet" href="/css/main.css" />
    </head>
    <body><?php
        echo $gv["content"]; ?>
    </body>
</html>
