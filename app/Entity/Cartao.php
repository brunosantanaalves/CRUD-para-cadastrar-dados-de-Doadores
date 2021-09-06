<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Cartao {

    /**
     * identificador unico do cartao
     * @var integer
     */
    public $id;

    /**
     * bandeira do cartao
     * @var string
     */
    public $bandeira;

    /**
     * numero do cartao
     * @var string (6 primeiros numeros, e 4 ultimos )
     */
    public $numero;

    /**
     * idetificador do doador dono do cartao
     * @var integer
     */
    public $doador;


    /** funcao responsavel por cadastrar dados do cartao */
    public function cadastrar(){
        //DEFINIR A DATA DE CADASTRO
        $this->cadastro = date('Y-m-d H:i:s');

        $db = new Database('cartao');
        $this->id = $db->insert([
                                    'bandeira' => $this->bandeira,
                                    'numero' => $this->numero,
                                    'doador' => $this->doador,
                                ]);

    }

    /** funcao responsavel por atualizar dados do cartao */
    public function atualizar(){
        return (new Database('cartao'))->update(' id = '.$this->id, [
                                                'bandeira' => $this->bandeira,
                                                'numero' => $this->numero,
                                                'doador' => $this->doador,
                                                                    ]);
    }

    /** funcao responsavel por apagar dados do cartao */
    public function excluir(){
        return (new Database('cartao'))->delete('id = '.$this->id);
    }

    /** funcao responsavel por buscar dados do cartao pelo id do doador */
    public static function getCartao($doador){
        return (new Database('cartao'))->select(' doador ='. $doador)
                                         ->fetchObject((self::class));
    }

}