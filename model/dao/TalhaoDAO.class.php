<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of TalhaoDAO
 *
 * @author anderson
 */
class TalhaoDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " TALHAO_ID AS \"idTalhao\" "
                    . " , PROPRAGR_ID AS \"idSecao\" "
                    . " , NRO AS \"codTalhao\" "
                . " FROM "
                    . " USINAS.V_INFEST_TALHAO ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
