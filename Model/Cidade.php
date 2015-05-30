<?php

class Cidade extends ContactPageAppModel {

	public $displayField = 'nome';

	public function findListaDeCidades($estadoId) {

		try {
			$opts['conditions']['Cidade.estado_id'] = $estadoId;
			return $this->find('list', $opts);

		} catch (MissingTableException $e) {
			$this->_setup($this->useTable);
			die("Tabela `{$this->useTable}` criado com sucesso.");
		}
	}
}