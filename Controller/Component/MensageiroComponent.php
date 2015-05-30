<?php

App::import('Config', 'ContactPage.PluginConfig');
App::uses('CakeEmail', 'Network/Email');

class MensageiroComponent extends Component {
	
	var $components = array('Email');
	
	/**
	 * Envia um email com um ou mais anexos, para um ou mais
	 * destinos.
	 *
	 * O destino seja uma String contendo vários emails
	 * separados por ',' ou ';', será enviado um email para 
	 * cada endereco.
	 * 
	 * @param  String 	$assunto 		Assunto do email.
	 * @param  String 	$destino 		Contém um ou mias emails separados por ','
	 *  ou ';'. Caso haja espaços, os mesmos serão removidos.
	 * @param  array 	$dados      	Array contendo os dados do email('produto'=>'mesa').
	 * @param  string 	$template    	Template do email.
	 * @param  array 	$attachments 	Um array contendo o nome e o path de cada arquivo
	 * que será anexado ao email. O path é de um arquivo em que já foi feito seu upload.
	 * Ex: array( 
	 * 			array(	
	 * 				'nome'=>arquivo1,
	 * 				'path' => 'path/pt/file.pdf'
	 * 		  	),
	 * 		    array(	
	 * 				'nome'=>arquivo2,
	 * 				'path' => 'path/pt/file2.pdf'
	 * 		  	),
	 * 		).
	 * @return Boolean              Confirma se todos os emails foram enviados.

	 */
	function enviar($assunto, $destinos, $dados, $template='default', $attachments = null) {

		$email = new CakeEmail('default');
		$email->subject($assunto);
		$email->emailFormat('html');
		$email->template($template);
		$email->viewVars($dados);
		
		if ($attachments != null) {
			$email->attachments($this->_getAnexos($attachments));
		}

		$destinos = preg_split("/[\,;]/", $destinos);

		foreach ($destinos as $destino) {
			$destino = trim($destino);
			$email->from(array($destino => PluginConfig::$config['nomeDoProjeto']));
			$email->to($destino);

			if (!$email->send()) {

				if (PluginConfig::$config['emailLog']) {
					$this->log('Houve um erro no envio do E-mail ('.$destino.')'."\r\n",'Mailing -'.date('d-m-Y'));
				}

				return false;
			}

			if (PluginConfig::$config['emailLog']) {
				$this->log('E-mail enviado com sucesso ('.$destino.')'."\r\n",'Mailing -'.date('d-m-Y'));
			}
		}

		return true;
	}


	private function _getAnexos() {

		$attachments = is_array($attachment)? $attachments : array($attachments);

		$files = array();
		$i=0;
		foreach ($attachments as $attachment) {
			$files[$attachment['name'] ] = array( 'file' => $attachment['path']);
			$i++;
		}
		return $files;
	}
}

