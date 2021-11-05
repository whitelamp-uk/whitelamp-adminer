<?php

class AdminerUnloading {

    function __construct ( ) {
    }

    function head ( ) {
?>
<link rel="stylesheet" type="text/css" href="../externals/jush/jush.css" />
<script nonce="<?php echo get_nonce(); ?>">
function unloading ( ) {
    document.body.classList.add ('unloading');
}
window.addEventListener ('beforeunload',unloading);
</script>
<?php
        return true;
    }

}


