<?php

namespace MeuProjeto\Models;

use MeuProjeto\Util\Conexao;
use PDO;
use MeuProjeto\Entity\Usuario;

class ModeloUsuario {

    public function __construct() {
        
    }

//    public function usuario($id) {
//        try {
//            $sql = "select * from usuario where idUsuario = :id and status = 1";
//            $p_sql = Conexao::getInstance()->prepare($sql);
//            $p_sql->bindValue(":id", $id);
//            $p_sql->execute();
//            return $p_sql->fetch(PDO::FETCH_OBJ);
//        } catch (Exception $ex) {
//            
//        }
//    }

    public function cadastrar(Usuario $usuario) {
        try {

            $sql = "insert into usuario (email, senha) values (:email, :senha)";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':email', $usuario->getEmail());
            $p_sql->bindValue(':senha', $usuario->getSenha());
            $p_sql->execute();
            return Conexao::getInstance()->lastInsertId();
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }
    }
    
    public function editar(Usuario $idEditado) {
        try {
            $sql = "update usuario set email = :email, senha = :senha where idUsuario = :idUsuario";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':idUsuario', $idEditado->getIdUsuario());
            $p_sql->bindValue(':email', $idEditado->getEmail());
            $p_sql->bindValue(':senha', $idEditado->getSenha());
            
            $p_sql->execute();
            //return $p_sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }
    }
    
    public function excluir($idUsuario) {

        try {
            $sql = "update usuario set status = 0 where idUsuario = :idUsuario";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':idUsuario', $idUsuario);
            return $p_sql->execute();
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }
    }

    public function mostrar($idUsuario) {

        try {

            $sql = "select * from usuario where idUsuario = :idUsuario";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':idUsuario', $idUsuario);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }
    }   

    public function validaLogin($email, $senha) {
        try {
            $sql = "select * from usuario where email = :email and senha = binary :senha";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":email", $email);
            $p_sql->bindValue(":senha", $senha);
            $p_sql->execute();
            if ($p_sql->rowCount() == 1) {
                return $p_sql->fetch(PDO::FETCH_OBJ);
            } else
                return false;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function qnt(){
        try{
            $sql = "select count(*) as qnt from usuario where status = 1";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $ex) {

        }
    }
}
