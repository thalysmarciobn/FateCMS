<?php
namespace Fate;

class Template {
	private $file, $content_file, $includeFile, $includeContent_file, $tags = array(), $tags_count = 0, $plugins = stdClass;
	
	public function __construct($plugins) {
		$this->plugins = $plugins;
	}
	
	public function getPlugins() {
		return $this->plugins;
	}
  
	public function open($file) {
		$file = urlencode($file);
		$file = str_replace(array("%2F","%5B","%5D"), array("/","[","]"), $file);
		$this->file = @fopen("../templates/" . $file, "r");
		if( $this->file == false) {
			exit("File not found: " . $file);
		}
		$this->content_file = @fread($this->file, filesize("../templates/" . $file));
		if ($this->content_file == false) {
			exit("Error reading file: " . $file);
		}
	}
	
	public function includeOpen($file) {
		$this->includeFile = @fopen("../templates/" . $file, "r");
		if ($this->includeFile == false) {
			exit("File not found: " . $file);
		}
		$this->includeContent_file = @fread($this->includeFile, filesize("../templates/" . $file));
		if ($this->includeContent_file == false) {
			exit("Error reading file: " . $file);
		}				
	}
	
	public function read($file) {
		if($file != null) {
			$data[0][0] = fopen($file, "r");
			$data[0][1] = fread($data[0][0], filesize($file));
			fclose($data[0][0]);
			return $data[0][1];
		}
	}
	
	public function set($tag, $value) {
		$this->tags[$this->tags_count++] = array("Name" => $tag, "Value" => $value);
	}
	
	public function includes() {
		$stop = false;
		while($stop == false) {
			$lastPos = 0;
			if(($beginCurrentPos = stripos($this->content_file, "{#INCLUDE:", $lastPos)) !== false) {
				//echo "Posição de inicio: {$beginCurrentPos}<br />";
				$lastPos = ++$beginCurrentPos;
				
				if(($endCurrentPos = stripos($this->content_file, "}", $lastPos)) !== false) {
					//echo "Posição de fim: {$endCurrentPos}<br />";
					$lastPos = ++$endCurrentPos;
					
					$fileNameInclude = substr($this->content_file, $beginCurrentPos+9, (($endCurrentPos-1) - ($beginCurrentPos+9)));
					
					$this->includeOpen($fileNameInclude);
					$this->content_file = str_replace("{#INCLUDE:".$fileNameInclude."}", $this->includeContent_file, $this->content_file);
				} else {
					$stop = true;
				}
						
			} else {
				$stop = true;
			}
		}
	}
	
	public function show() {
		$this->includes();
		for($Count_Sets = 0; $Count_Sets < count($this->tags); $Count_Sets++) {
			$this->content_file = str_replace("{#".$this->tags[$Count_Sets]['Name']."}", $this->tags[$Count_Sets]['Value'], $this->content_file);
		}
		eval('?>'.$this->content_file);
	}
	
	public function plain($type, $text) {
		Header("Content-type: " . $type);
		print $text; exit();	
	}
}