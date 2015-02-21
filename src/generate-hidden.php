<?php
header("Content-Type: text/plain; charset=utf-8");

require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "gustav", "src", "futape", "gustav", "GustavDest.php"));

use futape\gustav\GustavDest;

foreach(array("home.html", "blog.php", "search.php", "tags.php", "categories.php") as $val){
    $dest_a=new GustavDest(array($_SERVER["DOCUMENT_ROOT"], "src", "__hidden", $val));

    var_dump(
        $val,
        $dest_a->createFile()
    );
    echo "\n\n";
}
?>
