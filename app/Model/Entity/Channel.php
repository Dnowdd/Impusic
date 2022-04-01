<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class Channel{

    /**
     * ID do usuário
     * @var integer
     */
    public $id;

    /**
     * Username do canal
     * @var string
     */
    public $user;

    /**
     * Nome do canal
     * @var string
     */
    public $name;

    /**
     * Descricao do canal
     * @var string
     */
    public $description;

    /**
     * Email do canal
     * @var string
     */
    public $email;

    /**
     * Senha do canal
     * @var string
     */
    public $password;

    /**
     * Data de criação do canal
     * @var string
     */
    public $date;

    /**
     * Método responsável por cadastrar a instancia atual no banco de dados
     * @return boolean
     */
    public function cadastrar(){
        //INSERE A INSTANCIA NO BANCO
        $this->id = (new Database('channel'))->insert([
            'user' => $this->user,
            'name' => $this->name,
            'description' => $this->description,
            'email' => $this->email,
            'password' => $this->password,
            'date' => $this->date
        ]);

        //SUCESSO
        return true;
    }

    /**
     * Método responsável por atualizar os dados do banco
     * @return boolean
     */
    public function atualizar(){
        return (new Database('channel'))->update('id = '.$this->id,[
            'user' => $this->user,
            'name' => $this->name,
            'description' => $this->description,
            'email' => $this->email,
            'password' => $this->password,
            'date' => $this->date
        ]);
    }

    /**
     * Método responsável por excluir um usuário do banco
     * @return boolean
     */
    public function excluir(){
        return (new Database('channel'))->delete('id = '.$this->id);
    }

    /**
     * Método responsável por retornar uma instancia com base em seu id
     * @param integer $id
     * @return User
     */
    public static function getChannelById($id){
        return self::getChannels('id = "'.$id.'"')->fetchObject(self::class);
    }

    /**
     * Método responsável por retornar uma instancia com base em seu id
     * @param integer $id
     * @return User
     */
    public static function getChannelByEmail($id){
        return self::getChannels('email = "'.$id.'"')->fetchObject(self::class);
    }

    /**
     * Método responsável por retornar uma instancia com base em seu id
     * @param integer $id
     * @return User
     */
    public static function getChannelByUser($id){
        return self::getChannels('user = "'.$id.'"')->fetchObject(self::class);
    }

    /**
     * Método responsável por retornar Usuarios
     * @param string $where
     * @param string $order
     * @param string $limit
     * @param string $fields
     * @return PDOStatement
     */
    public static function getChannels($where = null, $order = null, $limit = null, $fields = '*'){
        return (new Database('channel'))->select($where,$order,$limit,$fields);
    }
}