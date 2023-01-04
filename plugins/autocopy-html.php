<script <?php echo nonce(); ?> >
document.addEventListener (
    'DOMContentLoaded',
    function ( ) {
        function autocopy (evt) {
            var bc,r,t,td,tds;
            if (evt.ctrlKey || evt.shiftKey) {
                // Adminer uses Ctrl-click for cell editing
                // Shift-click could be used for something else
                return;
            }
            t = evt.target;
            while (t!=evt.currentTarget) {
                if (t.tagName=='A') {
                    // Do not act inside links
                        return;
                }
                t = t.parentElement;
            }
            // Transitional style
            bg = t.style.backgroundColor;
            t.style.transition = 'all 1s'; 
            t.style.backgroundColor = 'red';
            setTimeout (
                function ( ) {
                    t.style.backgroundColor = bg;
                },
                1000
            );
            navigator.clipboard.writeText (t.innerText);
        }
        tds = document.querySelectorAll ('#table td');
        for (td of tds) {
            td.addEventListener ('click',autocopy);
        }
    }
);
</script>

