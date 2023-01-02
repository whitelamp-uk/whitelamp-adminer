
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
                                th.appendChild (img);
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
        var input,inputs,script;
        if (!('whitelampAdminer' in window)) {
            script = document.createElement ('script');
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
);


