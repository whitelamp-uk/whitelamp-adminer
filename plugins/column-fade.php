<?php

class ColumnFade {

    private $config;

    /** Print HTML code inside <head>
    * @return bool true to link favicon.ico and adminer.css if exists
    */
    function head ( ) {
        require __DIR__.'/column-fade-html.php';
    }

}

