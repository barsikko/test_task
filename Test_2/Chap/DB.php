<?php 

namespace Chap;

class DB
{
	private static $instance;

	public function __construct(){
		
		self::getInstance();	

	}

	static public function getInstance() :\PDO

	{
		try{
			$db = new \PDO("sqlite:chapter.db");  
			$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

			static::$instance = $db;

			$db->exec("CREATE TABLE IF NOT EXISTS TEXT_FIELD (
		                    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL , 
		                    TIME_DATE timestamp default CURRENT_TIMESTAMP, 
		                    TEXT_STR TEXT NOT nULL
		                )");
			}
		catch (\PDOException $e){
			echo $e->getMessage();
		}

		return static::$instance ?? (static::$instance = new static());
	}

		public function insertIntoDB($text){
				$query = static::$instance->prepare('INSERT INTO TEXT_FIELD (TEXT_STR) VALUES (:text)');
						$query->execute([':text' => $text]);
		}

		public function getTextByDateTime(){
			$db = static::$instance->query('SELECT TEXT_STR from TEXT_FIELD ORDER BY TIME_DATE DESC');	
	
			$res = $db->fetchAll(\PDO::FETCH_ASSOC);

			return $res;
		}

}