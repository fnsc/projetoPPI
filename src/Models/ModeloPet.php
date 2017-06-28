<?php

namespace MeuProjeto\Models;

use MeuProjeto\Util\Conexao;
use PDO;
use MeuProjeto\Entity\Pet;

class ModeloPet {
    public function __construct() {
        
    }
    
    public function cadastrar (Pet $pet){
        try {
        
            $sql = "insert into pet (idUsuario, nome, nascimento, raca) values (:idUsuario, :nome, :nascimento, :raca)";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':idUsuario', $pet->getIdUsuario());
            $p_sql->bindValue(':nome', $pet->getNome());
            $p_sql->bindValue(':nascimento', $pet->getNascimento());
            $p_sql->bindValue(':raca', $pet->getRaca());
            $p_sql->execute();
            return Conexao::getInstance()->lastInsertId();
        } catch (Exception $exc) {
            
            echo $exc->getTraceAsString();
        
        }
    }
    
    public function listar($idUsuario){
    
        try {
        
            $sql = "select * from pet where idUsuario = :idUsuario and status = 1";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':idUsuario', $idUsuario);
            $p_sql->execute();
            return $p_sql->fetchAll(PDO::FETCH_OBJ);
        }
        catch (Exception $exc) {
            
            echo $exc->getTraceAsString();
        
        }
    }
    
    public function mostrar($idPet, $idUsuario) {

        try {

            $sql = "select * from pet where idPet = :idPet and idUsuario = :idUsuario";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(':idUsuario', $idUsuario);
            $p_sql->bindValue(':idPet', $idPet);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exc) {

            echo $exc->getTraceAsString();
        }
    }
    
    public function excluir($idPet){
        
        try {
            $sql = "update pet set status = 0 where idpet = :idPet";
                $p_sql = Conexao::getInstance()->prepare($sql);
                $p_sql->bindValue(':idPet', $idPet);
                $p_sql->execute();
        }
        catch (Exception $exc) {
            
            echo $exc->getTraceAsString();
        
        }
    }
    
    public function editar(Pet $pet){
        try {
            $sql = "update pet set nome = :nome, nascimento = :nascimento, raca = :raca where idPet= :idPet";
                $p_sql = Conexao::getInstance()->prepare($sql);
                $p_sql->bindValue(':nome', $pet->getNome());
                $p_sql->bindValue(':nascimento', $pet->getNascimento());
                $p_sql->bindValue(':raca', $pet->getRaca());
                $p_sql->bindValue(':idPet', $pet->getIdPet());
                $p_sql->execute();
        }
        catch (Exception $exc) {
            
            echo $exc->getTraceAsString();
        
        }
    }
    
    public function qnt(){
        try{
            $sql = "select count(*) as qnt from pet where status = 1";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->execute();
            return $p_sql->fetch(PDO::FETCH_OBJ);
        } catch (Exception $ex) {

        }
    }
}
