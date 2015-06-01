<?php

App::import('Config', 'ContactPage.PluginConfig');

class Contato extends ContactPageAppModel {

    var $validate = array(
        'nome' => array(
            'rule1' => array(
                'rule' => 'notEmpty',
                'message' => 'O campo é obrigatório',
                'last'    => false
                ),
            'rule2' => array(
                'rule' => '/[a-z]+(\s[a-z\.]+)*/i',
                'message' => 'Números não são permitidos'
                )
            ),
        'email' => array(
            'rule' => 'email',
            'message' => 'E-mail inválido',
            'required' => true
            ),
        'telefone' => array(
            'rule' => 'notEmpty',
            'message' => 'O campo é obrigatório',
            'required' => true
            ),
        'estado_id' => array(
            'rule' => 'naturalNumber',
            'message' => 'O campo é obrigatório',
            'required'=> true,
            ),
        'cidade_id' => array(
            'rule' => 'naturalNumber',
            'message' => 'O campo é obrigatório',
            'required'=> true
            ),
        'mensagem' => array(
            'rule' => 'notEmpty',
            'message' => 'O campo é obrigatório',
            'required' => true
            ),
        'nobot' => array(
            'rule' => 'blank',
            'required'=> true
            )
        );

     var $sql = array(
        'pre' => "CREATE TABLE IF NOT EXISTS `contatos` (`id` int(11) NOT NULL AUTO_INCREMENT, ",
        'fields' => array(
            'nome' =>  "`nome` varchar(100) NOT NULL,",
            'email' =>  "`email` varchar(255) NOT NULL,",
            'telefone' =>  "`telefone` varchar(20) NOT NULL,",
            'estado_id' =>  "`estado_id` int(11) NOT NULL,",
            'cidade_id' =>  "`cidade_id` int(11) NOT NULL,",
            'mensagem' =>  "`mensagem` text NOT NULL,",
            ),
        'pos' => "`created` datetime NOT NULL, PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;"
        );
    
    function __construct() {
        parent::__construct();

        $this->useTable = PluginConfig::$config['Contato']['useTable'];

        foreach ($this->validate as $key => $value) {
            if (!in_array($key, PluginConfig::$config['Contato']['campos'])) {
                unset($this->validate[$key]);
                unset($this->sql['fields'][$key]);
            }
        }

        if ($this->useTable) {
            $path = $this->useTable.".sql";

            if (file_exists ($path)) {
                unlink($path);
            }
          
            $file = fopen(SCHEMA_PATH.$this->useTable.".sql", 'w');
            fwrite($file, $this->_gerarSQL());
            fclose($file);
        }
    }

    private function _gerarSQL() {
        $sql = $this->sql['pre'];
        foreach ($this->sql['fields'] as $value) {
            $sql .= $value;
        }
        $sql .= $this->sql['pos'];
        return $sql;
    }

    public function save($data = null , $validate = true , $fieldList = array()) {
        try {
            return parent::save($data, $validate, $fieldList);
        } catch (MissingTableException $e) {
            $this->_setup($this->useTable);
            die("Tabela `{$this->useTable}` criado com sucesso.");
        }
    }
}
