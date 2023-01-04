<?php

class InputConstraint {

        private $config;

/*


What input-constraint.js does
-----------------------------
  * asynchronously loads whitelamp-adminer.cfg.js
  * sets HTML <input pattern=""> on input/select elements as specified by regex values whitelampAdminer.inputConstraint.regexp.[item].pattern
  * adds event listener to match the input value to the regex
  * event listener adds/removes the class whitelampAdminer.inputConstraint.classNameFail from the element based on the match result
  * listens for HTML <input> keydown events as speficied by regexes in whitelampAdminer.inputConstraint.regexp[item].input
  * suppresses those events by calling Event.preventDefault() if Event.key does not match the regex value



What is needed
--------------

Add web-located ./input-constraint.js to all views with appropriate nonce-ification

*/


}

