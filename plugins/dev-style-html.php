<script <?php echo nonce(); ?> >
document.addEventListener (
    'DOMContentLoaded',
    function ( ) {
        document.body.classList.add ('dev-style');
    }
);
</script>
<style>
<?php require '/srv/whitelamp-adminer/dev-style.css'; ?>
</style>

