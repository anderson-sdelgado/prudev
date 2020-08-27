<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of CaracAmostOrg
 *
 * @author anderson
 */
class AmostraFitoDAO extends Conn {
    //put your code here
    
    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    public function dados() {

        $select = " SELECT "
                    . " ITAMOSORGA_ID AS \"idAmostra\" "
                    . " , AMOSORGAN_ID AS \"idAmostraOrgan\" "
                    . " , SEQ AS \"seqAmostra\" "
                    . " , CD AS \"codAmostra\" "
                    . " , CARACTER(DESCR) AS \"descrAmostra\" "
                    . " , CASE INT_MOB_DESCR "
                        . " WHEN 'NÚMERO PONTO' THEN 1 "
                        . " WHEN 'CAMPO CABEÇÁRIO' THEN 2 "
                        . " WHEN 'CAMPO ITEM' THEN 3 "
                        . " END AS \"tipoAmostra\" "
                . " FROM "
                    . " USINAS.V_INFEST_AMOSTRA ";
        
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        return $result;
        
    }
    
}
