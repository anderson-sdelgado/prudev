<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of TurmaDAO
 *
 * @author anderson
 */
class TurmaDAO extends Conn {
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT DISTINCT "
                    . " T.TURMA_ID AS \"idTurma\" "
                    . " , T.NRO AS \"codTurma\" "
                    . " , CARACTER(T.NOME) AS \"descrTurma\" "
                . " FROM "
                    . " USINAS.V_SIMOVA_TURMA T "
                    . " , V_SIMOVA_TURMA_FUNC TF "
                . " WHERE "
                    . " T.TURMA_ID = TF.TURMA_ID "
                    . " AND " 
                    . " T.TURMA_ID <> 111 "
                . " ORDER BY "
                    . " T.NRO "
                . " ASC ";

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
