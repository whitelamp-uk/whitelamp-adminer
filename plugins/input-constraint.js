
document.addEventListener (
    'DOMContentLoaded',
    function ( ) {
        function inputInput (evt) {
        }
        function inputKeydown (evt) {
        }
        function init ( ) {
            var input,inputs,script;
            // First JS plug-in to asynchronously load window.whitelampAdminer suppresses other plug-ins from trying to do the same
            if (!('whitelampAdminer' in window)) {
                window.whitelampAdminer = {};
                script = document.createElement ('script');
                script.src = './whitelamp-adminer.cfg.js';
                script.addEventListener ('load',icons);
                document.head.appendChild (script);
            }
            inputs = document.querySelectorAll ('input');
        }
        init ();
    }
);


