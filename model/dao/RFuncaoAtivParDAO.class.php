<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../dbutil/Conn.class.php');
/**
 * Description of RFuncaoAtivPar
 *
 * @author anderson
 */
class RFuncaoAtivParDAO extends Conn  {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " ATIVAGR_ID AS \"idAtivPar\" "
                    . " , CASE "
                    . " WHEN A.ATIVAGR_ID = 631 THEN 1 "
                    . " WHEN A.ATIVAGR_ID = 648 THEN 2 "
                    . " WHEN A.ATIVAGR_ID = 651 THEN 3 "
                    . " END AS \"codFuncao\" "
                    . " , 1  AS \"tipoFuncao\" "
                . " FROM "
                    . " USINAS.V_SIMOVA_ATIVAGR_NEW A "
                . " WHERE "
                    . " A.ATIVAGR_ID IN (648, 631, 651) ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
