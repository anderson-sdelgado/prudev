<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of AmostraSoqueiraDAO
 *
 * @author anderson
 */
class AmostraSoqueiraDAO extends Conn {

    public function verifAmostra($idCabec, $amostra) {

        $select = " SELECT "
                . " COUNT(ID) AS QTDE "
                . " FROM "
                . " PRU_SOQUEIRA_AMOSTRA "
                . " WHERE "
                . " SEQ = " . $amostra->seqAmostraSoqueira
                . " AND "
                . " CABEC_ID = " . $idCabec;

        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);
        $this->Read->execute();
        $result = $this->Read->fetchAll();

        foreach ($result as $item) {
            $v = $item['QTDE'];
        }

        return $v;
        
    }
    
    public function insAmostra($idCabec, $amostra) {
        
        $sql = "INSERT INTO PRU_SOQUEIRA_AMOSTRA ( "
                . " CABEC_ID "
                . " , SEQ "
                . " , TARA "
                . " , TOLETE "
                . " ) VALUES( "
                . " " . $idCabec
                . " , " . $amostra->seqAmostraPerda
                . " , " . $amostra->qtdeSoqueira
                . " , " . $amostra->qtdeArranquio
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
        
    }
    
}
