<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Doador {

    
    /**
     * identificador unico do doador
     * @var integer 
     */ 
    public $id;

    /**
     *  nome do doador
     * @var string
     */ 
    public $nome;

    /**
     *  Email do doador
     * @var string
     */ 
    public $email;

    /**
     * cpf do doador 
     *  @var string
     */ 
    public $cpf;

    /**
     * telfone do doador
     * @var string
     */ 
    public $telefone;

    /**
     * data de nascimento do doador
     * @var string
     */
    public $nascimento;

    /**
     * data do cadastro do doador
     * @var string
     */
    public $cadastro;

    /**
     * intervalo de doacoes
     * @var string
     */
    public $intervalo;

    /**
     * forma de pagamento (1 credito, 2 debito)
     * @var int
     */
    public $formaPagamento;
    
    /**
     * valor a ser doado
     * @var float
     */
    public $doacao;

    
    /** funcao responsavel por cadastrar dados do doador */
    public function Cadastrar(){
        //DEFINIR A DATA DE CADASTRO
        $this->cadastro = date('Y-m-d H:i:s');

        $db = new Database('doadores');
        $this->id = $db->insert([
                                    'nome' => $this->nome,
                                    'cpf' => $this->cpf,
                                    'email' => $this->email,
                                    'telefone' => $this->telefone,
                                    'nascimento' => $this->nascimento,
                                    'cadastro' => $this->cadastro,
                                    'intervalo' => $this->intervalo,
                                    'doacao' => $this->doacao,
                                    'formaPagamento' => $this->formaPagamento,
                                ]);

    }


    /** funcao responsavel por atualizar dados do doador */
    public function atualizar(){
        return (new Database('doadores'))->update(' id = '.$this->id, [
                                                                        'nome' => $this->nome,
                                                                        'cpf' => $this->cpf,
                                                                        'email' => $this->email,
                                                                        'telefone' => $this->telefone,
                                                                        'nascimento' => $this->nascimento,
                                                                        'cadastro' => $this->cadastro,
                                                                        'intervalo' => $this->intervalo,
                                                                        'doacao' => $this->doacao,
                                                                        'formaPagamento' => $this->formaPagamento,
                                                                    ]);
    }

    /** funcao responsavel por excluir dados do doador */
    public function excluir(){
        return (new Database('doadores'))->delete('id = '.$this->id);
    }

    /** funcao responsavel por buscar todos os doadores do banco */
    public static function getDoadores($where= null, $order = null, $limit = null){
        return (new Database('doadores'))->select($where,$order,$limit)
                                      ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    /** funcao responsavel por buscar um doador por id */
    public static function getDoador($id){
        return (new Database('doadores'))->select(' id ='. $id)
                                         ->fetchObject((self::class));

    }
    
}