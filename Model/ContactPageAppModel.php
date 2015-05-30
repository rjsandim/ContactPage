<?php

class ContactPageAppModel extends AppModel {

	protected function _setup($nameFile) {
		$handle = fopen(SCHEMA_PATH.$nameFile.".sql", "r");
		$sql = stream_get_contents($handle);
		$this->query($sql);
	}

}

?>