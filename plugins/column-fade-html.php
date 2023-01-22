<script <?php echo nonce(); ?> >
document.addEventListener (
    'DOMContentLoaded',
    function ( ) {
        function classAdd ( ) {
            var cell,cs,col,cols,i,j,params,prop,row,rows,s,th,ths;
            s = new URLSearchParams (window.location.search);
            params = Object.fromEntries (s.entries());
            if (params.db && params.select) {
                ths = document.querySelectorAll ('#table th');
                cols = whitelampAdminer.columnFade.columns;
                cs = [];
                for (i=0;cols[i];i++) {
                    if (cols[i][0]==params.db && cols[i][1]==params.select) {
                        j = 1; // First thead column is a td
                        for (th of ths) {
                            j++;
                            if (th.id=='th['+cols[i][2]+']') {
                                cs.push (j);
                                break;
                            }
                        }
                    }
                }
                if (cs.length) {
                    rows = document.querySelectorAll ('#table tbody tr');
                    for (row of rows) {
                        for (i=0;cs[i];i++) {
                        col = row.querySelector ('td:nth-of-type('+cs[i]+')');
                            if (col) {
                                col.classList.add ('column-fade');
                            }
                        }
                    }
                }
            }
        }
        function init ( ) {
            var input,inputs,script;
            // First JS plug-in to asynchronously load window.whitelampAdminer suppresses other plug-ins from trying to do the same
            if ('whitelampAdminer' in window) {
                if (Object.keys(whitelampAdminer).length) {
                    // Config already loaded
                    classAdd ();
                }
                else {
                    // Config already loading
                    script = document.querySelector ('script.whitelamp-adminer-cfg');
                    script.addEventListener ('load',classAdd);
                }
            }
            else {
                // Load config
                window.whitelampAdminer = {};
                script = document.createElement ('script');
                script.classList.add ('whitelamp-adminer-cfg');
                script.src = './whitelamp-adminer.cfg.js';
                script.addEventListener ('load',classAdd);
                document.head.appendChild (script);
            }
        }
        init ();
    }
);
</script>
<link rel="stylesheet" href="./column-fade.css" />

