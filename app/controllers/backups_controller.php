<?php
class BackupsController extends AppController {
	
	var $name = 'Backups';
	var $uses = null;
	
	function index() {
		$dirname = ROOT . DS . 'app' . DS . 'backups' . DS;
		$dh = opendir($dirname);
		$files = array();
		while (false !== ($entry = readdir($dh))) {
			if ($entry!= '..' && $entry!= '.') {
				$files[] = $entry;
			}
		}
		$this->set('backups', array_reverse($files));
	}
	
	function view($file) {
		$fh = fopen(ROOT.DS."app".DS."backups".DS.$file, 'r');
		$content = fread($fh, filesize(ROOT.DS."app".DS."backups".DS.$file));
		fclose($fh);
		$this->set('file', $content);
		$this->set('filename', $file);
	}

	function save($tables = '*') {
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
		
		$handle = fopen('../backups/backup-'.time().'.sql','w+');
		fwrite($handle,$return);
		fclose($handle);
		
		$this->Session->setFlash(__('Database backup created', true));
		$this->redirect(array('action' => 'index'));
	}

	function cron_save($tables = '*') {
		$this->autoRender = false;
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
		
		$handle = fopen(ROOT.DS."app".DS."backups".DS.'backup-'.time().'.sql','w+');
		fwrite($handle,$return);
		fclose($handle);
	}
	
	function restore($file) {
		$this->autoRender = false;
		
		App::import('Core', 'ConnectionManager');
		$dataSource = ConnectionManager::getDataSource('default');	
		$host = $dataSource->config['host'];
		$user = $dataSource->config['login'];
		$pass = $dataSource->config['password'];
		$name = $dataSource->config['database'];
	
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
		
		
		$filename = ROOT.DS."app".DS."backups".DS.$file;
		$templine = '';
		$lines = file($filename);
		foreach ($lines as $line_num => $line) {
			if (substr($line, 0, 2) != '--' && $line != '') {
				$templine .= $line;
				if (substr(trim($line), -1, 1) == ';') {
					mysql_query($templine);
					$templine = '';
				}
			}
		}
		$this->Session->setFlash($file.' was restored');
		$this->redirect(array('action'=>'index'));			
	}
	
	function delete($file) {	
		if (!$file) {
			$this->Session->setFlash(__('Invalid file', true));
			$this->redirect(array('action'=>'index'));
		}
		else {
			if (unlink('../backups/'.$file)) {
				$this->Session->setFlash($file.' was deleted');
				$this->redirect(array('action'=>'index'));
			}
		}
	}
	
}
?>