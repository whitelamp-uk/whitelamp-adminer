<?php

class Barcode {

        private $config;

/*


What it does
------------
  1. Handles of frisky barcode readers in Adminer input elements.
     Asterisk and enter keys being "typed" into the input is undesirable.
  2. Gets Adminer to display to screen and/or print the barcode font.


What is needed
--------------

As specified by the config:
  1. Add class barcode-in to <input>s
  2. Add the classes barcode-out and barcode-print to a containing element of a cell value (<td> perhaps?)
     See barcode-out in action: https://playpen.markpage.net/lime-retail/stores/test.html

Get the IIFE plugins/barcode.js to run after the browser DOM has loaded - using <script defer> probably?


The first bit of code here
--------------------------
if (is_readable('./barcode.cfg.php')) {
    $this->config = require ('./barcode.cfg.php');
}
if (!is_array($this->config)) {
    $this->config = [];
}


*/


}

