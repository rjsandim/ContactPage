<?
	if (!empty($errors)) {
		foreach ($errors as $key => $value) {
			$key = $key == 'cidade_id'? 'cidade' : $key;
 			$key = $key == 'estado_id'? 'estado' : $key;
?>
			<strong><?=$key;?></strong>:
<? 			
			$size = count($value);
			for ($i = 0; $i < $size; $i++) {
				if($i == $size - 1) {
					echo $value[$i].".";
				} else { 
					echo $value[$i].",";
				}
			}
		}
	} else {
?>
		enviado
<?
	}
?>