<?php

App::import('Config', 'ContactPage.PluginConfig');

class ContatosController extends ContactPageAppController {
	
	public $uses = array('ContactPage.Estado', 'ContactPage.Cidade', 'ContactPage.Contato');
	public $components = array('ContactPage.Mensageiro');

	public function index() {

		if (in_array('estado_id', PluginConfig::$config['Contato']['campos'])) {
			$this->set('estados', $this->Estado->findListaDeEstados());
		}
	}

	public function enviar() {

		$this->layout = 'ajax';

		if($this->request->is('post') && !empty($this->request->data)) {

			$this->Contato->set($this->request->data);
			if (!$this->Contato->validates()) {
				$this->set('errors',$this->Contato->validationErrors);
				return;
			}

			if (PluginConfig::$config['salvar']) {
				$this->Contato->save(null, false);
			}

			if (PluginConfig::$config['enviarEmail']) {
				$dados['assunto'] = PluginConfig::$config['assunto'];
				$dados['dados'] = $this->_getDadosComNomeDeCidadeEstado($this->request->data['Contato']);
				$this->Mensageiro->enviar(PluginConfig::$config['assunto'], PluginConfig::$config['destino'], $dados, PluginConfig::$config['template']);	
			}
		}
	}

	public function buscarCidadesPeloIdDoEstado($id) {
		$this->layout = 'ajax';
		$this->set('cidades', $this->Cidade->findListaDeCidades($id));
	}

	private function _getDadosComNomeDeCidadeEstado($dados) {

		foreach ($dados as $key => $value) {
			
			if ($key == "estado_id") {
				$estado = $this->Estado->findById($value);
				unset($dados[$key]);
				$dados['estado'] = $estado['Estado']['nome'];
			}
			if ($key == "cidade_id") {
				$cidade = $this->Cidade->findById($value);
				unset($dados[$key]);
				$dados['cidade'] = $cidade['Cidade']['nome'];
			}
		}

		return $dados;
	}
	
}
