<?php
class BackupShell extends Shell {
	
	function main($tables = '*') {
		App::import('Core', 'ConnectionManager');
		$dataSource = ConnectionManager::getDataSource('default');	
		$host = $dataSource->config['host'];
		$user = $dataSource->config['login'];
		$pass = $dataSource->config['password'];
		$name = $dataSource->config['database'];
	
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);

		if($tables == '*') {
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while($row = mysql_fetch_row($result)) {
				$tables[] = $row[0];
			}
		}
		else {
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		
		$return = null;
		foreach($tables as $table) {
			$result = mysql_query('SELECT * FROM '.$table);
			$num_fields = mysql_num_fields($result);
			
			$return.= 'DROP TABLE '.$table.';';
			$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
			$return.= "\n\n".$row2[1].";\n\n";

			for ($i = 0; $i < $num_fields; $i++) {
				while($row = mysql_fetch_row($result)) {
					$return.= 'INSERT INTO '.$table.' VALUES(';
					for($j=0; $j<$num_fields; $j++) {
						$row[$j] = addslashes($row[$j]);
						$row[$j] = ereg_replace("\n","\\n",$row[$j]);
						if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
						if ($j<($num_fields-1)) { $return.= ','; }
					}
					$return.= ");\n";
				}
			}
			
			$return.="\n\n\n";
		}
		
		$handle = fopen(ROOT.DS."app".DS."backups".DS."backup-".time().".sql", "w+");
		fwrite($handle,$return);
		fclose($handle);
		
		$this->out('Database backup saved');
	}
	
}
?>