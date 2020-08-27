<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of OSDAO
 *
 * @author anderson
 */
class OSDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    
    public function dados($os) {

        $select = " SELECT DISTINCT "
                    . " NRO_OS AS \"nroOS\" "
                    . " , NVL(PROPRAGR_ID, 0) AS \"idSecao\" "
                    . " , NVL(PROPRAGR_CD, 0) AS \"codSecao\" "
                    . " , NVL(PROPRAGR_DESCR, 'NULO') AS \"descrSecao\" "
                    . " , NVL(FRENTE_ID, 0) AS \"idFrente\" "
                    . " , NVL(FRENTE_DESCR, 'NULO') AS \"descrFrente\" "
                . " FROM "
                    . " USINAS.V_SIMOVA_OS_MANUAL "
                . " WHERE "
                    . " NRO_OS = " . $os;
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
    }
    
}
