<?php

class Autocopy {

        private $config;

        /** Print HTML code inside <head>
        * @return bool true to link favicon.ico and adminer.css if exists
        */
        function head() {
                ?>

<script <?php echo nonce(); ?>>
function autocopy (evt) {
    var bc,r,t;
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
    /* do border
    bc = t.style.borderColor;
    bw = t.style.borderWidth;
    t.style.borderColor = 'red';
    //t.style.borderWidth = 'thick';
    setTimeout (function(){ t.style.borderColor=bc; t.style.borderWidth=bw; }, 1000);
    */

    // do background
    bg = t.style.backgroundColor;
    t.style.transition = 'all 1s'; 
    t.style.backgroundColor = 'red';
    setTimeout (function(){ t.style.backgroundColor = bg; }, 1000);

    navigator.clipboard.writeText(t.innerText);

    /* This way is apparently deprecated
    r = document.createRange ();
    r.selectNodeContents (t);
    window.getSelection().addRange (r);
    document.execCommand ('copy');
    */
}
document.addEventListener (
        'DOMContentLoaded',
        function ( ) {
        var td,tds;
        tds = document.querySelectorAll ('#table td');
        for (td of tds) {
            td.addEventListener ('click',autocopy);
        }
    }
);
</script>

<?php
        }

}



