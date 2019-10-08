<?php

class FS 
{
	public function setContent($data)
	{
		$title = "{$data['title']}";
		$content = stripslashes("<h2>{$data['title']}</h2>
		<p>{$data['content']}</p>");
		return $this->bindContent($title,$content);
	}

	private function bindContent($data,$data1) {
		
		return '<!DOCTYPE html> 
<html lang="en"> 
<head> 
	<meta charset="UTF-8"> 
	<title>'.$data.'</title> 
</head> 
<body>
	'. $data1 .'
</body> 
</html>';
	}
}
