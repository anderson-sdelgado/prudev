<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of AmostraOrganismoDAO
 *
 * @author anderson
 */
class OrganFitoDAO extends Conn {
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT DISTINCT "
                    . " ORGDANINHO_ID AS \"idOrgan\" "
                    . " , CD AS \"codOrgan\" "
                    . " , CARACTER(DESCR) AS \"descrOrgan\" "
                . " FROM "
                    . " USINAS.V_INFEST_ORGAN ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
