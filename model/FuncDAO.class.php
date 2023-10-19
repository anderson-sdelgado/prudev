<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of FuncionarioDAO
 *
 * @author anderson
 */
class FuncDAO extends Conn {
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                        . " TF.FUNC_ID AS \"idFunc\" "
                        . " , TF.TURMA_ID AS \"idTurma\" "
                        . " , FM.FUNC_CD AS \"matricFunc\" "
                        . " , FM.FUNC_NOME AS \"nomeFunc\" "
                        . " , 2 AS \"tipoAlocaFunc\" "
                    . " FROM " 
                        . " V_SIMOVA_TURMA_FUNC TF "
                        . " , V_SIMOVA_FUNC_MOBRA FM "
                    . " WHERE "
                        . " TF.TURMA_ID <> 111 "
                        . " AND "
                        . " TF.FUNC_ID = FM.FUNC_ID ";
        
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
