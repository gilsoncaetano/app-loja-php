<?php 
// Esse arquivo é responsável com a comunicação com o banco e a preparação com o banco

class Usuario{
    public $idusuario;
    public $nomeusuario;
    public $senha;
    public $foto;

    // Criando construtor para inicializar a class
    public function __construct($db){
        $this->conexao = $db;
    }

    /* -------------------------------------------------------------------------- */

    // Função para listar todos os usuários cadastrados no banco de dados
    public function listar(){
        $query = "select * from tbusuario";

        // Será criada a variável stmt (Statement - Sentença)
        // para guardar a preparação da consulta select que será 
        // executada posteriormente
        $stmt = $this->conexao->prepare($query);

        // Executar a consulta e retornar os dados
        $stmt->execute();
        return $stmt;
    }

    /* -------------------------------------------------------------------------- */

    // Função para cadastrar um usuário no banco de dados
    public function cadastro(){
        $query = "insert into tbusuario set nomeusuario=:l, senha=:s, foto=:f";
        
        $stmt = $this->conexao-> prepare($query);

        // Encriptografar a senha com o uso de md5
        $this->senha = md5($this->senha);

        // Vamos vincular os dados que vem do app ou navegador com os
        // campos de banco de dados (bind)
        $stmt->bindParam(":l", $this->nomeusuario);
        $stmt->bindParam(":s", $this->senha);
        $stmt->bindParam(":f", $this->foto);

        if ($stmt->execute()){
            return true;
        }else{
                return false;
            }
        }

    /* -------------------------------------------------------------------------- */

        // Função para alterar a senha de um usuário no banco de dados
        public function alterarSenha(){
            $query = " update tbusuario set senha=:s where idusuario=:id";

            $stmt = $this->conexao-> prepare($query);

            // Encriptografar a senha com o uso de md5
            $this->senha = md5($this->senha);

            // Vamos vincular os dados que vem do app ou navegador com os
            // campos de banco de dados (bind)
            $stmt->bindParam(":s",  $this->senha);
            $stmt->bindParam(":id", $this->idusuario);

            if ($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }

    /* -------------------------------------------------------------------------- */

        // Função para alterar a foto de um usuário no banco de dados
        public function alterarFoto(){
            $query = " update tbusuario set foto=:f where idusuario=:id";

            $stmt = $this->conexao-> prepare($query);

            // Vamos vincular os dados que vem do app ou navegador com os
            // campos de banco de dados (bind)
            $stmt->bindParam(":f",  $this->foto);
            $stmt->bindParam(":id", $this->idusuario);

            if ($stmt->execute()){
                return true;
            }else{
                return false;
            }    
        }

    /* -------------------------------------------------------------------------- */

        // Função para apagar um usuário do banco de dados
        public function apagarUsuario(){
            $query = "delete from tbusuario where idusuario=:id";
        
            $stmt = $this->conexao-> prepare($query);
    
            // Vamos vincular os dados que vem do app ou navegador com os
            // campos de banco de dados (bind)
            $stmt->bindParam(":id", $this->idusuario);
    
            if ($stmt->execute()){
                return true;
            }else{
                return false;
            }   
        }
}
?>
