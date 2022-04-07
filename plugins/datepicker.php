<?php

class Datepicker {
	/** Get options to display edit field
	* @param string table name
	* @param array single field from fields()
	* @param string attributes to use inside the tag
	* @param string
	* @return string custom input field or empty string for default
	*/
	function editInput($table, $field, $attrs, $value) {
		if ($field["type"] == "date") {
			return "<input id='fields-" . h($field["field"]) . "' value='" . h($value) . "' type='date' ".$attrs." >";
		}
		return "";
	}
}
