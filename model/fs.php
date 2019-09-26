<?php

class FS 
{
	public function setContent($data)
	{
		$title = "{$data['title']}";
		$content = "<h2>{$data['title']}</h2>
		<p>{$data['content']}</p>";
		return $this->bindContent($content,$title);
	}

	private function bindContent($data,$data1) {
		
		return '<!DOCTYPE html> 
<html lang="en"> 
<head> 
	<meta charset="UTF-8"> 
	<title>'.$data1.'</title> 
</head> 
<body>
	'. $data .'
</body> 
</html>';
	}
}
