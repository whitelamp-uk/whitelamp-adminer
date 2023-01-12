<?php

class Unloading {

    function __construct ( ) {
    }

    function head ( ) {
?>

<script defer nonce="<?php echo get_nonce(); ?>">
function unloading (evt) {
    document.body.classList.add ('unloading');
    setTimeout (function(){document.body.classList.remove ('unloading')},3000);
}
window.addEventListener ('beforeunload',unloading);
</script>
<?php

    }

}


