<?php

    final class Connection {

        static $error_mysqli = array();
        public $mysqli;

        public function __construct($mysqli) {
        $this->mysqli = $mysqli;
			try {
				if ($mysqli->connect_error) {
					throw new Exception(mysqli_connect_error());
					exit();
				}
			} catch (Exception $error) {
				array_push($error_mysqli, $error->getMessage());
			}
    	}

		 public function query($qry, $params = []) {
			$paramsGiven = [];
			$paramsReplace = [];
	
			foreach ($params as $param => $value) {
				$paramsGiven[] = ':' . $param;
				$paramsReplace[] = "'" . $this->mysqli->real_escape_string($value) . "'";
			}
	
			$qryString = str_replace($paramsGiven, $paramsReplace, $qry);
			$query = $this->mysqli->query($qryString) or die($this->mysqli->error);
	
			return $query;
		}
	
		public function __destruct() {
			$this->mysqli->close();
		}
	
		public function getInsertId() {
			return $this->mysqli->insert_id;
		}
	
		public function utf(){
			$this->mysqli->set_charset("utf8");
		}

    }

?>
