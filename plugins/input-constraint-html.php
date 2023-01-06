<script <?php echo nonce(); ?> >
document.addEventListener (
    'DOMContentLoaded',
    function ( ) {
        function init ( ) {
            var input,inputs,params,s,script;
            s = new URLSearchParams (window.location.search);
            params = Object.fromEntries (s.entries());
            if (params.db && params.edit) {
                // First JS plug-in to asynchronously load window.whitelampAdminer suppresses other plug-ins from trying to do the same
                if ('whitelampAdminer' in window) {
                    if (Object.keys(whitelampAdminer).length) {
                        // Config already loaded
                        inputInit ();
                    }
                    else {
                        // Config already loading
                        script = document.querySelector ('script.whitelamp-adminer-cfg');
                        script.addEventListener ('load',inputInit);
                    }
                }
                else {
                    // Load config
                    window.whitelampAdminer = {};
                    script = document.createElement ('script');
                    script.classList.add ('whitelamp-adminer-cfg');
                    script.src = './whitelamp-adminer.cfg.js';
                    script.addEventListener ('load',inputInit);
                    document.head.appendChild (script);
                }
            }
        }
        function inputInit ( ) {
            var db,i,ip,ips,j,o,os,r,s,select,t;
            if (!('inputConstraint' in whitelampAdminer)) {
                console.log ('whitelampAdminer.inputConstraint is not defined');
                return;
            }
            if (!('regexp' in whitelampAdminer.inputConstraint)) {
                console.log ('whitelampAdminer.inputConstraint.regexp is not defined');
                return;
            }
            r = whitelampAdminer.inputConstraint.regexp;
            s = new URLSearchParams (window.location.search);
            params = Object.fromEntries (s.entries());
            db = params.db;
            t = params.edit;
            if ('pattern' in r) {
                for (i=0;r.pattern[i];i++) {
                    if (r.pattern[i][0]==db) {
                        if (r.pattern[i][1]==t) {
                            ips = document.querySelectorAll ('table.layout td:nth-child(3) input, table.layout td:nth-child(3) select');
                            for (ip of ips) {
                                if (ip.name=='fields['+r.pattern[i][2]+']') {
                                    ip.setAttribute ('pattern',r.pattern[i][3]);
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            if ('keydown' in r) {
                for (i=0;r.keydown[i];i++) {
                    if (r.keydown[i][0]==db) {
                        if (r.keydown[i][1]==t) {
                            ips = document.querySelectorAll ('table.layout td:nth-child(3) input, table.layout td:nth-child(3) select');
                            for (ip of ips) {
                                if (ip.name=='fields['+r.keydown[i][2]+']') {
                                    ip.addEventListener ('input',inputInput);
                                    ip.dataset.keyregexp = r.keydown[i][3];
                                    ip.addEventListener ('keydown',inputKeydown);
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            if ('readonly' in r) {
                for (i=0;r.readonly[i];i++) {
                    if (r.readonly[i][0]==db) {
                        if (r.readonly[i][1]==t) {
                            ips = document.querySelectorAll ('table.layout td:nth-child(3) input, table.layout td:nth-child(3) select');
                            for (ip of ips) {
                                if (ip.name=='fields['+r.readonly[i][2]+']') {
                                    ip.setAttribute ('readonly','');
                                    select = ip.closest('tr').querySelector('td:first-of-type select');
                                    for (j=0;select.options[j];j++) {
                                        if (j!=select.selectedIndex) {
                                            select.options[j].dataset.remove = 'remove';
                                        }
                                    }
                                    os = select.querySelectorAll ('[data-remove]');
                                    for (o of os) {
                                        o.remove ();
                                    }
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
        function inputInput (evt) {
            var pattern;
            pattern = evt.currentTarget.getAttribute ('pattern');
            if (pattern) {
                if (pattern.indexOf('A-Z')>0) {
                    evt.currentTarget.value = evt.currentTarget.value.toUpperCase ();
                }
                else if (pattern.indexOf('a-z')>0) {
                    evt.currentTarget.value = evt.currentTarget.value.toLowerCase ();
                }
                pattern = new RegExp ('^'+pattern+'$');
                if (pattern.test(evt.currentTarget.value)) {
                    evt.currentTarget.style.borderColor = '';
                }
                else {
                    evt.currentTarget.style.borderColor = 'red';
                }
            }
        }
        function inputKeydown (evt) {
            var char,pattern;
            char = evt.key;
            if (!(/^.$/u.test(char))) {
                // not a single unicode character
                return;
            }
            pattern = evt.currentTarget.dataset.keyregexp;
            if (pattern) {
                if (pattern.indexOf('A-Z')>0) {
                    char = char.toUpperCase ();
                }
                if (pattern.indexOf('a-z')>0) {
                    char = char.toLowerCase ();
                }
                pattern = new RegExp (pattern);
                if (!pattern.test(char)) {
                    evt.preventDefault ();
                }
            }
        }
        init ();
    }
);
</script>
<link rel="stylesheet" href="./barcode.css" />

