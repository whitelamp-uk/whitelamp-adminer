<?php

class DevStyle {

        private $config;

    /** Print HTML code inside <head>
    * @return bool true to link favicon.ico and adminer.css if exists
    */
    function head ( ) {
        /*
          * asynchronously load shared whitelamp-adminer.cfg.js
          * make a dev database look different by styling <body>
        */
        if (file_exists('/srv/whitelamp-adminer/dev-style.css')) {
            require __DIR__.'/dev-style-html.php';
        }
    }

}

