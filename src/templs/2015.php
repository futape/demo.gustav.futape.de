<?php
    require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "gustav", "src", "futape", "gustav", "GustavBase.php"));
    require_once implode(DIRECTORY_SEPARATOR, array(rtrim($_SERVER["DOCUMENT_ROOT"], DIRECTORY_SEPARATOR), "php", "gustav", "src", "futape", "gustav", "Gustav.php"));
    
    use futape\gustav\GustavBaseHooks;
    use futape\gustav\Gustav;
?>

<header>
    <h1><a href="/">gustav.futape.de</a></h1>
    <p class="subtitle">Showcasing Gustav</p>
    <nav>
        <ul>
            <li><a href="/blog/">Blog</a></li>
            <li><a href="/categories/">Categories</a></li>
            <li><a href="/tags/">Tags</a></li>
            <li><a href="/search/">Search</a></li>
        </ul>
    </nav>
</header>

<main><?php
    echo $gv["content"]; ?>
</main>

<footer>
    Copyright &copy; <?php echo date("Y", !is_null($gv["src"]->getBlock("_pub")) ? $gv["src"]->getBlock("_pub") : time()); ?> FooCorp &bull; Powered by <a href="http://gustav.futape.de">Gustav</a> &bull; Source code publically available on <a href="https://github.com/futape/gustav.futape.de">GitHub</a>.
</footer>
