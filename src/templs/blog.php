<?php
    require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "futape", "gustav", "GustavBase.php"));
    require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "futape", "gustav", "Gustav.php"));
    
    use futape\gustav\GustavBaseHooks;
    use futape\gustav\Gustav;
?>

<article><?php
    $arr_cat=$gv["src"]->getCategory();
    
    if(count($arr_cat)>0 || !is_null($gv["src"]->getBlock("_title")) || !is_null($gv["src"]->getBlock("_desc"))){ ?>
        <header><?php
            if(count($arr_cat)>0){ ?>
                <p><?php
                    $str_catPath=Gustav::getConf(Gustav::CONF_DEST_DIR);
                    
                    foreach($arr_cat as $i=>$val){
                        $str_catPath=GustavBaseHooks::path2url(array($str_catPath, $val), false);
                        
                        echo ($i>0 ? ' &raquo; ' : "").'<a href="/search/?term=&amp;cat='.urlencode($str_catPath).'">'.GustavBaseHooks::escapeHtml($val).'</a>';
                    } ?>
                </p><?php
            }
            
            if(!is_null($gv["src"]->getBlock("_title"))){ ?>
                <h1><?php echo GustavBaseHooks::escapeHtml($gv["src"]->getBlock("_title")); ?></h1><?php
            }
            
            if(!is_null($gv["src"]->getBlock("_desc"))){ ?>
                <p><?php echo GustavBaseHooks::escapeHtml($gv["src"]->getBlock("_desc")); ?></p>
                <hr /><?php
            } ?>
        </header><?php
    }
    
    echo $gv["content"];
    
    if(count($gv["src"]->getBlock("_tags"))>0 || !is_null($gv["src"]->getBlock("_pub")) || count($arr_cat)>0){ ?>
        <footer>
            <hr /><?php
            
            if(!is_null($gv["src"]->getBlock("_pub")) || count($arr_cat)>0){ ?>
                <p>Published<?php
                    if(!is_null($gv["src"]->getBlock("_pub"))){
                        echo " on ".date('j.n.Y G:i', $gv["src"]->getBlock("_pub"));
                    }
                    
                    if(count($arr_cat)>0){
                        echo ' in <a href="/search/?term=&amp;cat='.urlencode($str_catPath).'">'.GustavBaseHooks::escapeHtml($arr_cat[count($arr_cat)-1]).'</a>';
                    } ?>
                </p><?php
            }
            
            if(count($gv["src"]->getBlock("_tags"))>0){
                echo '<p><strong>Tags:</strong> '.GustavBaseHooks::escapeHtml(implode(", ", $gv["src"]->getBlock("_tags"))).'</strong></p>';
            } ?>
        </footer><?php
    } ?>
</article>
