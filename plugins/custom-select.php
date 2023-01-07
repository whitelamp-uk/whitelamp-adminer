<?php


class CustomSelect {

    // Adds default Adminer select (WHERE) restrictions when the view loads

    private $config;

    function head ( ) {
        echo "<style>\n";
        echo ".whitelamp-adminer-custom-select{margin-right:8px;width:24px;height:24px;content:url('./custom-select-icon.png');}\n"
        echo "</style>\n";
    }

    function tablesPrint ($tables) {
        if (is_readable('./custom-select.cfg.php')) {
            $this->config = require './custom-select.cfg.php';
        }
        if (!is_array($this->config)) {
            $this->config = [];
        }
        $db = Adminer::database ();
        if (!array_key_exists($db,$this->config)) {
            return null;
        }
        $Adminer = adminer ();
        echo '<ul id="tables">';
        echo script ('mixin(qs("#tables"),{onmouseover:menuOver,onmouseout:menuOut});');
        foreach ($tables as $table=>$status) {
            $name = $Adminer->tableName ($status);
            if ($name!='') {
                echo '<li><a href="'.h(ME).'select='.urlencode($table);
                echo $this->config[$db]['all_tables'];
                if (isset($this->config[$db]['per_table'][$table])) {
                    echo $this->config[$db]['per_table'][$table];
                }
                echo '"'.bold(
                    $_GET["select"]==$table || $_GET["edit"]==$table,
                    'select'
                );
                echo '>';
                echo '<img class="whitelamp-adminer-custom-select" />';
                echo lang ('select')
                echo '</a>';
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

