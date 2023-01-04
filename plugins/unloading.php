<?php

class Unloading {

    function __construct ( ) {
    }

    function head ( ) {
?>

<script nonce="<?php echo get_nonce(); ?>">
function unloading ( ) {
    document.body.classList.add ('unloading');
}
window.addEventListener ('beforeunload',unloading);
</script>
<?php

    }

}


