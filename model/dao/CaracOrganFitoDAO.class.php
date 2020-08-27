<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of CaracOrganismoDAO
 *
 * @author anderson
 */
class CaracOrganFitoDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT DISTINCT "
                    . " GRCARACORG_ID AS \"idCaracOrgan\" "
                    . " , CD AS \"codCaracOrgan\" "
                    . " , CARACTER(DESCR) AS \"descrCaracOrgan\" "
                . " FROM "
                    . " USINAS.GR_CARAC_ORGAN ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
