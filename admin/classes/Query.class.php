<?php

class Query extends Database {

    function storeDetails($table, $params, $id = NULL) {
        $q = (($id) ? 'UPDATE ' . $table . ' SET ' . $params . $id : 'INSERT INTO ' . $table . ' SET ' . $params);
        //echo $q,'<hr>';exit;
        $retVal = (string) ($this->change($q)) ? true : 'Err0';
        return $retVal;
    }

    function delData($table, $id = NULL, $cond = NULL) {
        if ($cond == NULL) {
            if ($id == NULL) {
                $q = 'TRUNCATE TABLE ' . $table;
            } else {
                $q = 'DELETE FROM ' . $table . ' WHERE ' . $id;
            }
			//echo $q;
        } else {
            $q = 'DELETE FROM ' . $table;
            if ($id) {
                $q .= ' WHERE ' . $id;
            }
        }
        return $this->change($q);
    }

    function fetchRecord($table, $params = ' * ', $cond = NULL) {
        $q = 'SELECT' . $params . 'FROM ' . $table . (($cond) ? ' WHERE ' . $cond : '');
        $this->query($q);
        //echo $q,'<hr>';
        return $this->getRowObject();
    }

    function fetchAllRecord($table, $params = ' * ', $cond = NULL, $search = NULL, $ord = NULL, $ordkey = 'ASC', $startPt = 0, $limit = MAX_ENTRIES_PER_PAGE) {
        $suffix = '';
        if ($cond)
            $suffix = ' WHERE ' . $cond;
        if ($search)
            $suffix .= (($cond) ? ' AND ' : ' WHERE ') . $search;

        $q = 'SELECT ' . $params . 'FROM ' . $table;
        $this->query($q . $suffix);
        $this->totalcnt = $this->_rowCount;
        if ($ord)
		{
		$arr = explode(',', $ord);
		$ord_arr = count($arr);
		$key = explode(',', $ordkey);
		$ord_key = count($key);
		
		
		if($ord_arr > 1)
		{
			for($k=0; $k<$ord_arr; $k++){
								$tmp_ord[] = $arr[$k].'  ';
								for($l=$k; $l == $k; $l++){
								$tmp_key[] = $tmp_ord[$k].$key[$l];
							}
						} 
		
			$suffix .= ' ORDER BY ' . implode(',', $tmp_key);
		}
		else {
			
			$suffix .= ' ORDER BY ' . $ord . ' ' . $ordkey;
		}  
	}
        if ($limit != 'All')
            $suffix .= ' LIMIT ' . $startPt . ',' . $limit;

        $q .= $suffix;
        //echo $q,'<hr>';
		//exit;
        return $this->query($q);
    }

    function callProcedure() {
        $arg = func_get_args();
        $cnt = (int) func_num_args();
        $params = (string) '(';
        for ($i = 1; $i < $cnt; $i++) {
            $params .= $arg[$i] . ',';
        }
        $q = 'CALL ' . $arg[0] . trim($params, ',') . ');';
        if (strpos($arg[$cnt - 1], '@') != -1) {
            mysql_query($q, $this->_resConn);
            $q = ' SELECT ' . $arg[$cnt - 1] . ';';
        }
        return mysql_query($q, $this->_resConn);
    }

    function addToDB($tbl) {
        $sql_columns = array();
        $sql_columns_use = array();
        $sql_value_use = array();

        $pull_cols = mysql_query("SHOW COLUMNS FROM " . $tbl, $this->_resConn) or die("MYSQL ERROR: " . mysql_error());

        while ($columns = mysql_fetch_assoc($pull_cols))
            $sql_columns[] = $columns["Field"];

        foreach ($_POST as $key => $value) {
            if (in_array($key, $sql_columns) && htmlspecialchars(trim($value))) {
                if ($value == "DATESTAMP")
                    $sql_value_use[] = "NOW()";
                else
                    $sql_value_use[] = "'" . addslashes($value) . "'";

                $sql_columns_use[] = $key;
            }
        }

        if ((sizeof($sql_columns_use) == 0) || (sizeof($sql_value_use) == 0)) {
            $this->Error = "Error: No values were passed that matched any columns.";
            return false;
        } else {
            $this->SQLStatement = "INSERT INTO " . $tbl . " (" . implode(",", $sql_columns_use) . ") VALUES (" . implode(",", $sql_value_use) . ")";

            //echo $this->SQLStatement;
            //echo "<br>";
            //exit;
            if (@mysql_query($this->SQLStatement, $this->_resConn))
                return mysql_insert_id();
            else {
                $this->Error = "Error: " . mysql_error();
                return false;
            }
        }
    }

    function updateDB($tbl, $id, $id_name) {
        $sql_columns = array();
        $sql_value_use = array();

        $pull_cols = mysql_query("SHOW COLUMNS FROM " . $tbl, $this->_resConn) or die("MYSQL ERROR:" . mysql_error());
        while ($columns = mysql_fetch_assoc($pull_cols))
            $sql_columns[] = $columns["Field"];

        foreach ($_POST as $key => $value) {

            if (in_array($key, $sql_columns) && htmlspecialchars(trim($value))) {
                if ($value == 'DATESTAMP') {
                    $sql_value_use[] = $key . "=NOW()";
                } else {
                    $sql_value_use[] = $key . "='" . trim(addslashes($value)) . "'";
                }
            }
        }

        if (sizeof($sql_value_use) == 0) {
            $this->Error = "Error: No values were passed that matched any columns.";
            return false;
        } else {
            $this->SQLStatement = "UPDATE " . $tbl . " SET " . implode(",", $sql_value_use) . " WHERE " . $id_name . "=" . $id;
			//echo $this->SQLStatement,'<hr>';
			if (@mysql_query($this->SQLStatement, $this->_resConn))
				return true;
			else {
				$this->Error = "Error: " . mysql_error();
				return false;
			}
        }
    }

    function getRecord($sql) {
        $result = mysql_query($sql, $this->_resConn) or die("Query failed with error:" . mysql_error() . " SQL: " . $sql);
        $row = mysql_fetch_array($result, MYSQL_ASSOC);
        return $row;
    }

    function newID($tbl, $id) {
        $sql = "select max(" . $id . ") as cnt from " . $tbl;
        $row = $this->getRecord($sql);
        return $row['cnt'] + 1;
    }

    function generatenextid($tblname, $colname, $strname, $strcode = '000', $cond = NULL) {
        $q = 'SELECT MAX(CAST(SUBSTRING(' . $colname . ', ' . strlen($strname . $strcode) . ', length(' . $colname . ')) AS UNSIGNED)) maxid FROM ' . $tblname . (($cond) ? ' WHERE ' . $cond : '');

        $this->query($q);
        $cnt = (int) $this->getRowCount();
        $prefix = $strname . $strcode;

        if ($cnt < 1) {
            return $prefix . '1';
        }

        $obj = $this->getRowObject();
        $new_id = (int) $obj->maxid + 1;

        return $prefix . $new_id;
    }//end of Method
}//End of class
