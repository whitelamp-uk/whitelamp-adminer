<?php


class CustomSelect {

        private $config;

	function tablesPrint($tables) {
                if (is_readable('./custom-select.cfg.php')) {
                    $this->config = require ('./custom-select.cfg.php');
                }
                if (!is_array($this->config)) {
                    $this->config = [];
                }
		$db = Adminer::database();
		//print_r($db);
		//print_r($this->config);
		if (!isset($this->config[$db])) {
			return null;
		}

		//print_r(get_defined_functions());

		$Adminer = adminer();

		echo "<ul id='tables'>" . script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");
		foreach ($tables as $table => $status) {
			$name = $Adminer->tableName($status);
			if ($name != "") {
				echo '<li><a href="' . h(ME) . 'select=' . urlencode($table) ;

				echo $this->config[$db]['all_tables'];
				if (isset($this->config[$db]['per_table'][$table])) {
					echo $this->config[$db]['per_table'][$table];
				}

				echo '"'.bold($_GET["select"] == $table || $_GET["edit"] == $table, "select") ;

				echo ">+" . lang('select') . "</a> ";

				echo (support("table") || support("indexes")
					? '<a href="' . h(ME) . 'table=' . urlencode($table) . '"'
						. bold(in_array($table, array($_GET["table"], $_GET["create"], $_GET["indexes"], $_GET["foreign"], $_GET["trigger"])), (is_view($status) ? "view" : "structure"))
						. " title='" . lang('Show structure') . "'>$name</a>"
					: "<span>$name</span>"
				) . "\n";
			}
		}
		echo "</ul>\n";
		return true;
	}

}
