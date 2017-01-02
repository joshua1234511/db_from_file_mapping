<?php
class database
	{
		var $onError   = "die"; // die, email, or nothing

		var $db;
		var $dbname;
		var $host;
		var $password;
		var $queries;
		var $result;
		var $user;
		var $redirect = false;
		
		var $affectedRows;
		var $foundRows;
		var $returnedRows;

		function database($host, $user, $password, $dbname = null)
		{
			$this->host     = $host;
			$this->user     = $user;
			$this->password = $password;
			$this->dbname   = $dbname;			
			$this->queries  = array();
		}
		
		function connect()
		{
			$this->db = @mysql_connect($this->host, $this->user, $this->password) or $this->notify();
			if($this->dbname != "")
				mysql_select_db($this->dbname, $this->db) or $this->notify();
		}

		function query($sql)
		{
		
			// reset the affectedRows
			unset($this->affectedRows);
			
			// Optionally allow extra args which are escaped and inserted in place of
			// their corresponding question mark placeholders.
			if(func_num_args() > 1)
			{
				$args = func_get_args();
				// Surely there's a faster way than doing it this way, right?
				for($i = 1; $i < func_num_args(); $i++)
				{
					$args[$i] = str_replace("?", "[[qmark]]", $args[$i]);
					$sql = preg_replace('/\?/', $this->quote($args[$i]), $sql, 1);
				}
				$sql = str_replace("[[qmark]]", "?", $sql);
			}
			
			$this->queries[] = $sql;
			$this->result = mysql_query($sql, $this->db) or $this->notify();
			
			// check if it is a SELECT query
			if (preg_match("/^SELECT/i", trim($sql)) > 0) {
				$isSelectQuery = TRUE;
			// if not a SELECT query
			} else {
				$isSelectQuery = FALSE;
			}
			
			if ($isSelectQuery) {
				// the returnedRows property holds the number of records returned by a SELECT query
				$this->returnedRows = mysql_num_rows($this->result);
				
				// get the number of records that would've been returned if there was no LIMIT
				$rowsResult = mysql_query("SELECT FOUND_ROWS()", $this->db) or $this->notify();
				$foundRows  = mysql_fetch_assoc($rowsResult);
				$this->foundRows = $foundRows["FOUND_ROWS()"];
			} else {
				// the affectedRows property holds the number of affected rows by action queries (DELETE, INSERT, UPDATE)
				$this->affectedRows = mysql_affected_rows($this->db);
			}
			
			return $this->result;
		}

		// You can pass in nothing, a string, or a db result
		function getValue($arg = null)
		{
			if(is_null($arg) && $this->isValid())
				return mysql_result($this->result, 0, 0);
			elseif(is_resource($arg) && $this->isValid($arg))
				return mysql_result($arg, 0, 0);
			elseif(is_string($arg))
			{
				$this->query($arg);
				if($this->isValid())
					return mysql_result($this->result, 0, 0);
			}
			return false;
		}

		function numRows($arg = null)
		{
			if(is_null($arg) && $this->isValid())
				return mysql_num_rows($this->result);
			elseif(is_resource($arg) && $this->isValid($arg))
				return mysql_num_rows($arg);
			elseif(is_string($arg))
			{
				$this->query($arg);
				if($this->isValid())
					return mysql_num_rows($this->result);
			}
			return false;
		}

		// You can pass in nothing, a string, or a db result
		function getRow($arg = null)
		{
			if(is_null($arg) && $this->isValid())
				return mysql_fetch_array($this->result, MYSQL_ASSOC);
			elseif(is_resource($arg) && $this->isValid($arg))
				return mysql_fetch_array($arg, MYSQL_ASSOC);
			elseif(is_string($arg))
			{
				$this->query($arg);
				if($this->isValid())
					return mysql_fetch_array($this->result, MYSQL_ASSOC);
			}
			return false;
		}

		// You can pass in nothing, a string, or a db result
		function getRows($arg = null)
		{
			if(is_null($arg) && $this->isValid())
				$result = $this->result;
			elseif(is_resource($arg) && $this->isValid($arg))
				$result = $arg;
			elseif(is_string($arg))
			{
				$this->query($arg);
				if($this->isValid())
					$result = $this->result;
				else
					return array();
			}
			else
				return array();

			$rows = array();
			mysql_data_seek($result, 0);
			while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				$rows[] = $row;
			return $rows;
		}

		// You can pass in nothing, a string, or a db result
		function getObject($arg = null)
		{
			if(is_null($arg) && $this->isValid())
				return mysql_fetch_object($this->result);
			elseif(is_resource($arg) && $this->isValid($arg))
				return mysql_fetch_object($arg);
			elseif(is_string($arg))
			{
				$this->query($arg);
				if($this->isValid())
					return mysql_fetch_object($this->result);
			}
			return false;
		}

		function getObjects($arg = null)
		{
			if(is_null($arg) && $this->isValid())
				$result = $this->result;
			elseif(is_resource($arg) && $this->isValid($arg))
				$result = $arg;
			elseif(is_string($arg))
			{
				$this->query($arg);
				if($this->isValid())
					$result = $this->result;
				else
					return array();
			}
			else
				return array();

			$objects = array();
			mysql_data_seek($result, 0);
			while($object = mysql_fetch_object($result))
				$objects[] = $object;
			return $objects;
		}

		function isValid($result = null)
		{
			if(is_null($result)) $result = $this->result;
			return is_resource($result) && (mysql_num_rows($result) > 0);
		}

		function quote($var) { return "'" . mysql_real_escape_string($var, $this->db) . "'"; }
		function quoteParam($var) { return $this->quote($_REQUEST[$var]); }
		function numQueries() { return count($this->queries); }
		function lastQuery() { return $this->queries[count($this->queries) - 1]; }
		function lastId() { return mysql_insert_id(); }

		function notify()
		{
			global $auth;
			
			$err_msg = mysql_error($this->db);
			error_log($err_msg);

			switch($this->onError)
			{
				case "die":
				  $lastquery = $this->lastQuery();
					echo "<p style='border:5px solid red;background-color:#fff;padding:5px;'><strong>Database Error:</strong><br/>$err_msg</p>";
					echo "<p style='border:5px solid red;background-color:#fff;padding:5px;'><strong>Last Query:</strong><br/>" . $this->lastQuery() . "</p>";
					echo "<pre>";
					debug_print_backtrace();
					echo "</pre>";
					die();
					break;
				
				
			}

			if($this->redirect === true)
			{
				exit();
			}
		}
	}