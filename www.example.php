<?php

function adminer_object() {
    include_once "/var/www/adminer/plugins/plugin.php";
    include_once "/var/www/adminer/plugins/url-hyperlink.php";
    $plugins = array(
        new UrlHyperlink
    );
    return new AdminerPlugin ($plugins);
}

require '/var/www/adminer/adminer.php';

