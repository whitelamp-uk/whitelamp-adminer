<?php

class BlottoMaintenance {

    private $config;

    /** Print HTML code inside <head>
    * @return bool true to link favicon.ico and adminer.css if exists
    */
    function head ( ) {
        if (is_readable(__DIR__.'/blotto-maintenance.cfg.php')) {
            $this->config = include __DIR__.'/blotto-maintenance.cfg.php';
            if ($this->config && array_key_exists('blotto',$this->config)) {
                if (array_key_exists('maintenance_file',$this->config['blotto']) && $this->config['blotto']['maintenance_file']) {
                    if (file_exists($this->config['blotto']['maintenance_file'])) {
                        require __DIR__.'/blotto-maintenance-html.php';
                    }
                }
            }
        }
    }

}

