<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once ('../dbutil/Conn.class.php');
/**
 * Description of AmostraPerdaDAO
 *
 * @author anderson
 */
class AmostraPerdaDAO extends Conn {
    
    public function verifAmostra($idCabec, $amostra) {

        $select = " SELECT "
                . " COUNT(ID) AS QTDE "
                . " FROM "
                . " PRU_PERDA_AMOSTRA "
                . " WHERE "
                . " SEQ = " . $amostra->seqAmostraPerda
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
        
        $tara = '';
        if ($a->taraAmostraPerda == 0) {
            $tara = "null";
        } else {
            $tara = $amostra->taraAmostraPerda;
        }

        $tolete = '';
        if ($a->toleteAmostraPerda == 0) {
            $tolete = "null";
        } else {
            $tolete = ($a->toleteAmostraPerda - $a->taraAmostraPerda);
        }

        $canaInteira = '';
        if ($a->canaInteiraAmostraPerda == 0) {
            $canaInteira = "null";
        } else {
            $canaInteira = ($a->canaInteiraAmostraPerda - $a->taraAmostraPerda);
        }

        $toco = '';
        if ($a->tocoAmostraPerda == 0) {
            $toco = "null";
        } else {
            $toco = ($a->tocoAmostraPerda - $a->taraAmostraPerda);
        }

        $pedaco = '';
        if ($a->pedacoAmostraPerda == 0) {
            $pedaco = "null";
        } else {
            $pedaco = ($a->pedacoAmostraPerda - $a->taraAmostraPerda);
        }

        $repique = '';
        if ($a->repiqueAmostraPerda == 0) {
            $repique = "null";
        } else {
            $repique = ($a->repiqueAmostraPerda - $a->taraAmostraPerda);
        }

        $ponteiro = '';
        if ($a->ponteiroAmostraPerda == 0) {
            $ponteiro = "null";
        } else {
            $ponteiro = ($a->ponteiroAmostraPerda - $a->taraAmostraPerda);
        }

        $lascas = '';
        if ($a->lascasAmostraPerda == 0) {
            $lascas = "null";
        } else {
            $lascas = ($a->lascasAmostraPerda - $a->taraAmostraPerda);
        }

        $sql = "INSERT INTO PRU_PERDA_AMOSTRA ( "
                . " IDCABEC "
                . " , NUM "
                . " , TARA "
                . " , TOLETE "
                . " , CANAINTEIRA "
                . " , TOCO "
                . " , PEDACO "
                . " , REPIQUE "
                . " , PONTEIRO "
                . " , LASCAS "
                . " , SOQUEIRAKG "
                . " , SOQUEIRANUM "
                . " , PEDRA "
                . " , TOCOARVORE "
                . " , PLDANINHAS "
                . " , FORMIGUEIRO "
                . " ) VALUES( "
                . " " . $idCabec
                . " , " . $amostra->seqAmostraPerda
                . " , " . $tara
                . " , " . $tolete
                . " , " . $canaInteira
                . " , " . $toco
                . " , " . $pedaco
                . " , " . $repique
                . " , " . $ponteiro
                . " , " . $lascas
                . " , null "
                . " , null "
                . " , " . $amostra->pedraAmostraPerda
                . " , " . $amostra->tocoArvoreAmostraPerda
                . " , " . $amostra->plantaDaninhasAmostraPerda
                . " , " . $amostra->formigueiroAmostraPerda
                . " )";

        $this->Conn = parent::getConn();
        $this->Create = $this->Conn->prepare($sql);
        $this->Create->execute();
    }
    
}
