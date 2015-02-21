<?php
require_once implode(DIRECTORY_SEPARATOR, array(rtrim(__DIR__, DIRECTORY_SEPARATOR), "..", "..", "GustavContent.php"));

use futape\gustav\GustavContentHooks;

echo GustavContentHooks::convContent($gv, "markdown", &$str_nextConv);

return $str_nextConv;
?>