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
        if ($amostra->taraAmostraPerda == 0) {
            $tara = "null";
        } else {
            $tara = $amostra->taraAmostraPerda;
        }

        $tolete = '';
        if ($amostra->toleteAmostraPerda == 0) {
            $tolete = "null";
        } else {
            $tolete = ($amostra->toleteAmostraPerda - $amostra->taraAmostraPerda);
        }

        $canaInteira = '';
        if ($amostra->canaInteiraAmostraPerda == 0) {
            $canaInteira = "null";
        } else {
            $canaInteira = ($amostra->canaInteiraAmostraPerda - $amostra->taraAmostraPerda);
        }

        $toco = '';
        if ($amostra->tocoAmostraPerda == 0) {
            $toco = "null";
        } else {
            $toco = ($amostra->tocoAmostraPerda - $amostra->taraAmostraPerda);
        }

        $pedaco = '';
        if ($amostra->pedacoAmostraPerda == 0) {
            $pedaco = "null";
        } else {
            $pedaco = ($amostra->pedacoAmostraPerda - $amostra->taraAmostraPerda);
        }

        $repique = '';
        if ($amostra->repiqueAmostraPerda == 0) {
            $repique = "null";
        } else {
            $repique = ($amostra->repiqueAmostraPerda - $amostra->taraAmostraPerda);
        }

        $ponteiro = '';
        if ($amostra->ponteiroAmostraPerda == 0) {
            $ponteiro = "null";
        } else {
            $ponteiro = ($amostra->ponteiroAmostraPerda - $amostra->taraAmostraPerda);
        }

        $lascas = '';
        if ($amostra->lascasAmostraPerda == 0) {
            $lascas = "null";
        } else {
            $lascas = ($amostra->lascasAmostraPerda - $amostra->taraAmostraPerda);
        }

        $sql = "INSERT INTO PRU_PERDA_AMOSTRA ( "
                . " CABEC_ID "
                . " , SEQ "
                . " , TARA "
                . " , TOLETE "
                . " , CANA_INTEIRA "
                . " , TOCO "
                . " , PEDACO "
                . " , REPIQUE "
                . " , PONTEIRO "
                . " , LASCAS "
                . " , SOQUEIRA_KG "
                . " , SOQUEIRA_NUM "
                . " , PEDRA "
                . " , TOCO_ARVORE "
                . " , PLANTA_DANINHAS "
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
