<?php

function adminer_object ( ) {

    require_once 'whitelamp-adminer/plugins/plugin.php';

    // Plugin class files
    @include_once 'whitelamp-adminer/plugins/custom-select.php';
    @include_once 'whitelamp-adminer/plugins/datepicker.php';
    @include_once 'whitelamp-adminer/plugins/frames.php';
    @include_once 'whitelamp-adminer/plugins/restricted-user.php';
    @include_once 'whitelamp-adminer/plugins/unloading.php';
    @include_once 'whitelamp-adminer/plugins/url-hyperlink.php';

    return new AdminerPlugin (
        [
            // Objects (comment out to taste)
            new CustomSelect,
            new Datepicker,
//            new Frames, // may cause problems with other plugins
            new RestrictedUser,
            new Unloading,
            new UrlHyperlink,
        ]
    );

}

require 'whitelamp-adminer/adminer.php';

