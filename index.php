<?php
	class lang
	{
		private $file;
		private $data;
		
		public function __construct($lang)
		{
			$this->file = simplexml_load_file($lang.'.strings');
			$this->loadData();
		}
		private function loadData()
		{
			foreach($this->file->ISTRING as $str)
			{
				$key = $str->KEY;
				$val = $str->VALUE;
				$this->data["$key"] = $val;
			}
		}
		
		public function getLang($key)
		{
			return $this->data[$key];
		}
	}
	$lang = ($_GET['lang']) ? $_GET['lang']:'en';
	$translate = new lang($lang);
	
	$arr = array('LANG_form_name'=>'', 'LANG_form_email'=>'');
	
	foreach($arr as $key=>$val)
	{
		$$key = $translate->getLang($key);
	}

	require_once 'template.php';
?>