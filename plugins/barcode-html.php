<script <?php echo nonce(); ?> >
document.addEventListener (
    'DOMContentLoaded',
    function ( ) {
        function icons ( ) {
            var cols,i,img,params,prop,s,th,ths;
            ths = document.querySelectorAll ('#table th');
            s = new URLSearchParams (window.location.search);
            params = Object.fromEntries (s.entries());
            if (params.db && params.select) {
                cols = whitelampAdminer.barcode.columns;
                for (i=0;cols[i];i++) {
                    if (cols[i][0]==params.db && cols[i][1]==params.select) {
                        for (th of ths) {
                            if (th.id=='th['+cols[i][2]+']') {
                                img = document.createElement ('img');
                                img.classList.add ('barcode-icon');
                                img.addEventListener (
                                    'click',
                                    function (evt) {
                                        evt.stopPropagation ();
                                        var cell,cells,count,j,thead,tr,trs;
                                        thead = evt.currentTarget.closest ('thead');
                                        cells = thead.querySelectorAll ('th');
                                        count = 0;
                                        for (cell of cells) {
                                            count++;
                                            if (cell==evt.currentTarget.parentElement) {
                                                break;
                                            }
                                        }
                                        count++;
                                        trs = thead.parentElement.querySelectorAll ('tbody tr');
                                        for (tr of trs) {
                                            cell = tr.querySelector ('td:nth-of-type('+count+')');
                                            if (cell.classList.contains('barcode')) {
                                                cell.classList.remove ('barcode');
                                            }
                                            else {
                                                cell.classList.add ('barcode');
                                            }
                                        }
                                    }
                                );
                                th.prepend (img);
                                return;
                            }
                        }
                    }
                }
            }
        }
        function inputInput (evt) {
            var v;
            v = evt.currentTarget.value;
            v = v.replace (/[\t]/g,"    ");
            v = v.replace (/[\r\n]/g,"");
            if (/\*.*\*/.test(v)) {
                v = v.slice (0,-1);
                v = v.slice (1);
            }
            evt.currentTarget.value = v;
        }
        function inputKeydown (evt) {
            if (evt.key=='Enter') {
                evt.preventDefault ();
            }
        }
        function init ( ) {
            var input,inputs,script;
            // First JS plug-in to asynchronously load window.whitelampAdminer suppresses other plug-ins from trying to do the same
            if ('whitelampAdminer' in window) {
                if (Object.keys(whitelampAdminer).length) {
                    // Config already loaded
                    icons ();
                }
                else {
                    // Config already loading
                    script = document.querySelector ('script.whitelamp-adminer-cfg');
                    script.addEventListener ('load',icons);
                }
            }
            else {
                // Load config
                window.whitelampAdminer = {};
                script = document.createElement ('script');
                script.classList.add ('whitelamp-adminer-cfg');
                script.src = './whitelamp-adminer.cfg.js';
                script.addEventListener ('load',icons);
                document.head.appendChild (script);
            }
            inputs = document.querySelectorAll ('input');
            for (input of inputs) {
                input.addEventListener ('keydown',inputKeydown);
                input.addEventListener ('input',inputInput);
            }
        }
        init ();
    }
);
</script>
<link rel="stylesheet" href="./barcode.css" />

