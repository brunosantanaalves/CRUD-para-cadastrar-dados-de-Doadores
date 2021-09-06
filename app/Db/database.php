<?php
namespace App\Db;

use \PDO;
use \PDOException;

class Database {
    /**
     * host de conexao do banco de dados
     * @var string
     */
    const HOST = 'localhost';
    
    /**
     * nome do banco de dados
     * @var string
     */
    const NAME = 'doacoes';

    /**
     * usuario  do banco de dados
     * @var string
     */
    const USER = 'root';

     /**
      * senha  do banco de dados
      * @var string
      */
    const PASS = '';

    /**
     * nome da tabela a ser manipulada
     * @var string
     */
    private $table;

    /**
     * Instancia de conexao com o banco de dados
     * @var PDO
     */
    private $connection;

    
    /** 
     * altera funcao de contrucao da classe 
     * para ser criada com o nome da tabela a ser manipulade 
     * */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * metodo responsavel por criar uma conexao com o banco de dados
     */
    private function setConnection(){
        try {
            $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    /**
     * metido responsavel por executar querios dentro do banco de dados 
     * @param string $query
     * @param array $params
     * @return PDOStatement
     */
    public function execute($query, $params = []){
        try {
            $statment = $this->connection->prepare($query);
            $statment->execute($params);
            return $statment;
        } catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }


    /**
     * metodo responsavel por inserir dados no banco 
     * @param array $values [ field => value ]
     * @return integer ID inserido
    */
    public function insert($values){
        //dados da query 
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?'); 

        //monta a query 
        $query = 'INSERT INTO '.$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';

        //executa o insert
        $this->execute($query, array_values($values));

        //retorna o id inserido 
        return $this->connection->lastInsertID();
    }

    /**
     * metodo responsavel por executar uma consulta no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return PDOStatment
     */

    public function select($where= null, $order = null, $limit = null, $fields = '*'){
        //dados da query
        $where = strlen($where) ? ' WHERE '. $where : '';
        $order = strlen($order) ? ' ORDER BY '. $order : '';
        $limit = strlen($limit) ? ' LIMIT '. $limit : '';

        // monta a query
        $query = 'SELECT '. $fields.' FROM '.$this->table. ' '. $where.' '.$order.' '.$limit;

        // executa a query 
        return $this->execute($query);
    }

    /**
     * metodo responsavel por atualizar o banco de dados
     * @param string $where 
     * @param array $values [ field => value ]
     * @return boolean 
     */
    public function update($where, $values){

        //dados da query 
        $fields = array_keys($values);
        
        //monta  a query
        $query = 'UPDATE '.$this->table. ' SET '.implode('=?,', $fields).'=? WHERE '.$where;

        //executa a query
        $this->execute($query, array_values($values));

        return true;
    }


    /**
     * metodo responsavel por excluir do banco dados
     * @param string $where
     * @return boolean 
     */
    public function delete($where){
        // monta a query
        $query = 'DELETE FROM '.$this->table.' WHERE '.$where;

        //executa a query 
        $this->execute($query);

        //retorna sucesso
        return true;
    }

}