<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Conta {

    /**
     * identificador da conta
     * @var integer
     */
    public $id;

    /**
     * numero da conta
     * @var string
     */
    public $conta;
    
    /**
     * numero da agencia da conta
     * @var string 
     */
    public $agencia;

    /**
     * identificador do doador dono da conta
     */
    public $doador;


    /** funcao responsavel por cadastrar dados da conta */
    public function Cadastrar(){
        //DEFINIR A DATA DE CADASTRO
        $this->cadastro = date('Y-m-d H:i:s');

        $db = new Database('contas');
        $this->id = $db->insert([
                                    'agencia' => $this->agencia,
                                    'conta' => $this->conta,
                                    'doador' => $this->doador,
                                ]);

    }


    /** funcao responsavel por atualizar dados da conta */
    public function atualizar(){
        return (new Database('contas'))->update(' id = '.$this->id, [
                                                                        'agencia' => $this->agencia,
                                                                        'conta' => $this->conta,
                                                                        'doador' => $this->doador,
                                                                    ]);
    }


    /** funcao responsavel por excluir dados da conta */
    public function excluir(){
        return (new Database('contas'))->delete('id = '.$this->id);
    }

    /** funcao responsavel por buscar dados da conta pelo id do doador */
    public static function getConta($doador){
        return (new Database('contas'))->select(' doador ='. $doador)
                                         ->fetchObject((self::class));
    }

}