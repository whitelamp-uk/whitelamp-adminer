<?php

function adminer_object ( ) {
    include_once '/var/www/adminer/plugins/plugin.php';
    // Class files
    include_once '/var/www/adminer/plugins/datepicker.php';
    include_once '/var/www/adminer/plugins/restricted-user.php';
    include_once '/var/www/adminer/plugins/unloading.php';
    include_once '/var/www/adminer/plugins/url-hyperlink.php';
    return new AdminerPlugin (
        [
            // Objects
            new Datepicker,
            new RestrictedUser,
            new Unloading,
            new UrlHyperlink
        ]
    );
}

require '/var/www/adminer/adminer.php';

