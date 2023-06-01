<script <?php echo nonce(); ?> >
document.addEventListener (
    'DOMContentLoaded',
    function ( ) {
        var div,e,es;
        es = document.querySelectorAll ('form');
        for (e of es) {
            e.style.display = 'none';
        }
        div = document.createElement ('div');
        div.classList.add ('error');
        div.textContent = 'This service is currently unavailable. It will be resumed as soon as possible.';
        e = document.querySelector ('#content');
        e.appendChild (div);
    }
);
</script>

