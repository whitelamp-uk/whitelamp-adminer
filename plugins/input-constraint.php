<?php

class InputConstraint {

        private $config;

    /** Print HTML code inside <head>
    * @return bool true to link favicon.ico and adminer.css if exists
    */
    function head ( ) {
/*
  * asynchronously load shared whitelamp-adminer.cfg.js
  * set HTML <input pattern=""> on input/select elements as specified by regex values whitelampAdminer.inputConstraint.regexp.[item].pattern
  * add event listener to match the input value to the regex
  * event listener to add/remove the class whitelampAdminer.inputConstraint.classNameFail from the element based on the match result
  * listen for HTML <input> keydown events as speficied by regexes in whitelampAdminer.inputConstraint.regexp[item].input
  * suppress those events by calling Event.preventDefault() if Event.key does not match the regex value
*/
        require __DIR__.'/input-constraint-html.php';
    }


}

