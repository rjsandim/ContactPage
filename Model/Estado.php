<?php

class Estado extends ContactPageAppModel {

	public $displayField = 'nome';

	public function findListaDeEstados() {

		try {
			return $this->find('list');

		} catch (MissingTableException $e) {
			$this->_setup($this->useTable);
			die("Tabela `{$this->useTable}` criado com sucesso.");
		}
	}
}