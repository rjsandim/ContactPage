<?php

define('SCHEMA_PATH', APP."Plugin".DS."ContactPage".DS."Config".DS."Schema".DS);

class PluginConfig {

	public static $config = array(
		'Contato' => array(
				'useTable' => 'contatos',
				'campos' => array('nome', 'email', 'telefone', 'estado_id', 'cidade_id', 'mensagem', 'nobot'),
			),
		'enviarEmail' => true,
		'salvar' => true,
		'assunto' => "Assunto do Email",
		'nomeDoProjeto' => "ContactPage",
		'destino' => "rjsandim@gmail.com, andremedalhaa@gmail.com",
		'template' => "padrao",
		'emailLog' => true,
		);
}