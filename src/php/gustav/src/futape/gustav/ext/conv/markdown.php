<?php
require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "phpmarkdown", "Michelf", "Markdown.inc.php"));

use Michelf\Markdown;

echo Markdown::defaultTransform($gv);

return "html";
?>
