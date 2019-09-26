 <?php 
		$str = "{{abc}} {{cde}}";

$str = preg_replace('/{{(\w+)}}/', '$1', $str);

echo $str;
	?>