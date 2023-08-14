<?php


class CustomSelect {

    // Adds default Adminer select (WHERE) restrictions when the view loads

    private $config;
    private $db;

    function configSet ( ) {
        $this->db = Adminer::database ();
        if (!$this->config) {
            if (is_readable('./custom-select.cfg.php')) {
                $config = require './custom-select.cfg.php';
                if (is_array($config) && array_key_exists($this->db,$config)) {
                    $this->config = $config[$this->db];
                }
            }
        }
    }

    function head ( ) {
        $this->configSet ();
        echo "<style>\n";
        echo "img.whitelamp-adminer-custom-select{width:12px;height:12px;content:url('./custom-select-icon.png');}\n";
        if (array_key_exists('css',$this->config)) {
            echo $this->config['css'];
        }
        echo "</style>\n";
    }

    function tablesPrint ($tables) {
        $this->configSet ();
        if (!$this->config) {
            return null;
        }
        $Adminer = adminer ();
        echo '<ul id="tables">';
        echo script ('mixin(qs("#tables"),{onmouseover:menuOver,onmouseout:menuOut});');
        foreach ($tables as $table=>$status) {
            $name = $Adminer->tableName ($status);
            if ($name!='') {
                echo '<li><a href="'.h(ME).'select='.urlencode($table);
                echo $this->config['all_tables'];
                if (isset($this->config['per_table'][$table])) {
                    echo $this->config['per_table'][$table];
                }
                echo '"'.bold(
                    $_GET["select"]==$table || $_GET["edit"]==$table,
                    'select'
                );
                echo '>';
                echo '<img class="whitelamp-adminer-custom-select" title="Customised search/sort" /> ';
                echo lang ('select');
                echo '</a> ';
                echo (
                    support ("table") || support("indexes")
                    ? '<a href="'.h(ME).'table='.urlencode($table).'"'
                        .bold(
                            in_array($table,array($_GET['table'],$_GET['create'],$_GET['indexes'],$_GET['foreign'],$_GET['trigger'])),
                            is_view($status) ? 'view' : 'structure'
                        )
                        .' title="'.lang('Show structure').'">'.$name.'</a>'
                    : '<span>'.$name.'</span>'
                )
                ."\n";
            }
        }
        echo '</ul>';
        echo "\n";
        return true;
    }

}

