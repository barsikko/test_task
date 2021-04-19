<?php 

namespace Chap;

use Chap\DB;

class Chapter
{
	public static function insertText($text)
	{
		(new DB)->insertIntoDB($text);		
	}

	public static function getFromDB()
	{
		 return	(new DB)->getTextByDateTime();
	}


}