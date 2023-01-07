<?php

class RestrictedUser {

    // Allows a user with limited column SELECT permissions to select results minus the disallowed columns

    function selectQueryBuild ($select,$where,$group,$order,$limit,$page) {
        $query = null;
        if (in_array('*',$select)) {
            $table = $_GET['select'];
            $fields = fields ($table);
            $columns = []; // selectable columns
            $text_length = null;
            foreach ($fields as $key=>$field) {
                if (isset($field['privileges']['select'])) {
                    $columns[$key] = $field['field'];
                }
            }
            if (count($fields)!=count($columns)) { // have select privilege on all columns
                $newselect = [];
                foreach ($select as $field) {  // possibly over the top..
                    if ($field=='*') {
                        $newselect = array_merge ($newselect,$columns);
                    }
                    else {
                        $newselect[] = $field;
                    }
                }
                $select = $newselect;
                $query = "SELECT" . limit (
                    (
                        $_GET["page"] != "last" && $limit != "" && $group && $is_group && $jush == "sql" ? "SQL_CALC_FOUND_ROWS " : "") . implode(", ", $select) . "\nFROM " . table($table
                    ),
                    (
                        $where ? "\nWHERE " . implode(" AND ", $where) : "") . ($group && $is_group ? "\nGROUP BY " . implode(", ", $group) : "") . ($order ? "\nORDER BY " . implode(", ", $order) : ""
                    ),
                    (
                        $limit != "" ? +$limit : null
                    ),
                    (
                        $page ? $limit * $page : 0
                    ),
                    "\n"
                );
            }
        }
        return $query;
    }

}

