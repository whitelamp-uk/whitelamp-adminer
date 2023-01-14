<script <?php echo nonce(); ?> >
document.addEventListener (
    'DOMContentLoaded',
    function ( ) {
        function autocopy (evt) {
            var bc,img,r,t,td,tds,txt;
            img = document.querySelector ('img.whitelamp-adminer-autocopy');
            if (img && img.classList.contains('active')) {
                evt.stopPropagation ();
                if (evt.ctrlKey || evt.shiftKey) {
                    // Adminer uses Ctrl-click for cell editing
                    // Shift-click could be used for something else
                    return;
                }
                t = evt.target;
                while (t!=evt.currentTarget) {
                    if (!txt) {
                        txt = t.innerText;
                    }
                    if (t.tagName=='A') {
                        // Do not act inside links
                            return;
                    }
                    t = t.parentElement;
                }
                // Flash background
                bg = t.style.backgroundColor;
                t.style.backgroundColor = 'rgb(255,127,127)';
                setTimeout (
                    function ( ) {
                        t.style.transition = 'background-color 0.8s';
                        t.style.backgroundColor = bg;
                        setTimeout (
                            function ( ) {
                                t.style.transition = '';
                            },
                            800
                        );
                    },
                    100
                );
                navigator.clipboard.writeText (txt);
            }
        }
        function toggle (evt) {
            var table;
            table = document.querySelector ('#table');
            if (table) {
                if (evt.currentTarget.classList.contains('active')) {
                    table.classList.remove ('whitelamp-adminer-autocopy');
                    evt.currentTarget.classList.remove ('active');
                }
                else {
                    table.classList.add ('whitelamp-adminer-autocopy');
                    evt.currentTarget.classList.add ('active');
                }
            }
        }
        tds = document.querySelectorAll ('#table td');
        for (td of tds) {
            td.addEventListener ('click',autocopy);
        }
        if (tds.length) {
            img = document.createElement ('img');
            img.classList.add ('whitelamp-adminer-autocopy');
            img.addEventListener ('click',toggle);
            document.body.appendChild (img);
        }
    }
);
</script>
<style>
img.whitelamp-adminer-autocopy {
    position: absolute;
    left: 1140px;
    top: 58px;
    border-style: solid;
    border-width: 1px;
    content: url('./autocopy-icon.png');
    cursor: pointer;
}
img.whitelamp-adminer-autocopy.active {
    content: url('./autocopy-icon-active.png');  
}
#table.whitelamp-adminer-autocopy td a:nth-child(1) {
    margin-left: 1em;
}
</style>

