
document.addEventListener (
    'DOMContentLoaded',
    function ( ) {
        function init ( ) {
            var input,inputs,params,s,script;
            s = new URLSearchParams (window.location.search);
            params = Object.fromEntries (s.entries());
            if (params.db && params.edit) {
                // First JS plug-in to asynchronously load window.whitelampAdminer suppresses other plug-ins from trying to do the same
                if (!('whitelampAdminer' in window)) {
                    window.whitelampAdminer = {};
                    script = document.createElement ('script');
                    script.src = './whitelamp-adminer.cfg.js';
                    script.addEventListener ('load',inputInit);
                    document.head.appendChild (script);
                }
            }
        }
        function inputInit (evt) {
            var db,i,ip,ips,r,s,t;
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
                                if (ip.name=='field['+r.pattern[i][2]+']') {
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
                                if (ip.name=='field['+r.keydown[i][2]+']') {
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
            if ('readonly' in whitelampAdminer.inputConstraint.readonly) {
                for (i=0;r.readonly[i];i++) {
                    if (r[i].readonly[0]==db) {
                        if (r.readonly[i][1]==t) {
                            ips = document.querySelectorAll ('table.layout td:nth-child(3) input, table.layout td:nth-child(3) select');
                            for (ip of ips) {
                                if (ip.name=='field['+r.readonly[i][2]+']') {
                                    ip.setAttribute ('readonly');
                                    ip.closest('tr').querySelector('td:nth-child(2) select').setAttribute ('readonly');
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
        function inputInput (evt) {
// evt.currentTarget.getAttribute ('pattern')
        }
        function inputKeydown (evt) {
// evt.currentTarget.dataset.keyregexp
        }
        init ();
    }
);


