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
            var db,i,ip,ips,j,o,os,p,r,s,select,t;
            if (!('inputConstraint' in whitelampAdminer)) {
                console.log ('whitelampAdminer.inputConstraint is not defined');
                return;
            }
            c = whitelampAdminer.inputConstraint;
            s = new URLSearchParams (window.location.search);
            params = Object.fromEntries (s.entries());
            db = params.db;
            t = params.edit;
            if ('pattern' in c) {
                for (i=0;c.pattern[i];i++) {
                    if (c.pattern[i][0]==db) {
                        if (c.pattern[i][1]==t) {
                            ips = document.querySelectorAll ('table.layout td:nth-child(3) input, table.layout td:nth-child(3) select');
                            for (ip of ips) {
                                if (ip.name=='fields['+c.pattern[i][2]+']') {
                                    p = new RegExp ('^'+c.regexp[c.pattern[i][3]][0]+'$');
                                    if (p.test(ip.value)) {
                                        ip.style.borderColor = '';
                                    }
                                    else {
                                        ip.style.borderColor = 'red';
                                    }
                                    ip.setAttribute ('pattern',c.regexp[c.pattern[i][3]][0]);
                                    ip.dataset.keyregexp = c.regexp[c.pattern[i][3]][1];
                                    ip.setAttribute ('title',c.regexp[c.pattern[i][3]][2]);
                                    ip.addEventListener ('keydown',inputKeydown);
                                    ip.addEventListener ('input',inputInput);
                                    break;
                                }
                            }
                        }
                    }
                }
            }
            if ('readonly' in c) {
                for (i=0;c.readonly[i];i++) {
                    if (c.readonly[i][0]==db) {
                        if (c.readonly[i][1]==t) {
                            ips = document.querySelectorAll ('table.layout td:nth-child(3) input, table.layout td:nth-child(3) select');
                            for (ip of ips) {
                                if (ip.name=='fields['+c.readonly[i][2]+']') {
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

