<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Endereco {

    /**
     * identificador do endereco
     * @var integer
     */
    public $id;

    /**
     * logradouro (nome da rua) do doador
     * @var string
     */
    public $logradouro;

    /**
     * bairro 
     * @var string
     */
    public $bairro;

    /**
     * cep
     * @var string
     */
    public $cep;

    /**
     * cidade
     * @var string
     */
    public $cidade;

    /**
     * estado
     * @var string
     */
    public $estado;

    /**
     * numero da residencia
     * @var integer
     */
    public $numero;

    /**
     * id do doador dono endereco
     * @var string
    */
    public $doador;

    /** funcao responsavel por cadastrar dados do endereco */
    public function Cadastrar(){
        //DEFINIR A DATA DE CADASTRO
        $this->cadastro = date('Y-m-d H:i:s');

        $db = new Database('enderecos');
        $this->id = $db->insert([
                                    'id' => $this->id,
                                    'logradouro' => $this->logradouro,
                                    'bairro' => $this->bairro,
                                    'cep' => $this->cep,
                                    'cidade' => $this->cidade,
                                    'estado' => $this->estado,
                                    'numero' => $this->numero,
                                    'doador' => $this->doador,
                                    
                                ]);

    }

    /** funcao responsavel por atualizar dados do endereco */
    public function atualizar(){
        return (new Database('enderecos'))->update(' id = '.$this->id, [
                                                                        'logradouro' => $this->logradouro,
                                                                        'bairro' => $this->bairro,
                                                                        'cep' => $this->cep,
                                                                        'cidade' => $this->cidade,
                                                                        'estado' => $this->estado,
                                                                        'numero' => $this->numero,
                                                                        'doador' => $this->doador,
                                                                    ]);
    }

    /** funcao responsavel por excluir dados do endereco */
    public function excluir(){
        return (new Database('enderecos'))->delete('id = '.$this->id);
    }

    /** funcao responsavel por buscas dados do endereco pelo id do doador */
    public static function getEndereco($doador){
        return (new Database('enderecos'))->select(' doador = '. $doador)
                                         ->fetchObject((self::class));
    }




}