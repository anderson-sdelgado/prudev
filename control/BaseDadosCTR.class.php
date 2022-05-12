<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../model/dao/AtivDAO.class.php');
require_once('../model/dao/AmostraFitoDAO.class.php');
require_once('../model/dao/CaracOrganFitoDAO.class.php');
require_once('../model/dao/EquipDAO.class.php');
require_once('../model/dao/FuncDAO.class.php');
require_once('../model/dao/LiderDAO.class.php');
require_once('../model/dao/OSDAO.class.php');
require_once('../model/dao/OrganFitoDAO.class.php');
require_once('../model/dao/ParadaDAO.class.php');
require_once('../model/dao/RFuncaoAtivParDAO.class.php');
require_once('../model/dao/ROCAFitoDAO.class.php');
require_once('../model/dao/ROSAtivDAO.class.php');
require_once('../model/dao/TalhaoDAO.class.php');
require_once('../model/dao/TipoApontDAO.class.php');
require_once('../model/dao/TurmaDAO.class.php');
/**
 * Description of BaseDadosCTR
 *
 * @author anderson
 */
class BaseDadosCTR {
    
    public function dadosAmostraFito() {

        $amostraFitoDAO = new AmostraFitoDAO();

        $dados = array("dados"=>$amostraFitoDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;

    }
    
    public function dadosAtiv() {
        
        $ativDAO = new AtivDAO();
        
        $dados = array("dados"=>$ativDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosCaracOrganFito() {

        $caracOrganFitoDAO = new CaracOrganFitoDAO();

        $dados = array("dados"=>$caracOrganFitoDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosEquip() {
        
        $equipDAO = new EquipDAO();

        $dados = array("dados"=>$equipDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }

    public function dadosFunc() {

        $funcDAO = new FuncDAO();

        $dados = array("dados"=>$funcDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosLider() {
        
        $liderDAO = new LiderDAO();

        $dados = array("dados"=>$liderDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    
    public function dadosOS($info) {

        $osDAO = new OSDAO();
        $rOSAtivDAO = new ROSAtivDAO();

        $dado = $info['dado'];

        $dadosOS = array("dados" => $osDAO->dados($dado));
        $resOS = json_encode($dadosOS);

        $dadosROSAtiv = array("dados" => $rOSAtivDAO->dados($dado));
        $resROSAtiv = json_encode($dadosROSAtiv);

        return $resOS . "#" . $resROSAtiv;
        
    }
    
    public function dadosOrganFito() {

        $organFitoDAO = new OrganFitoDAO();

        $dados = array("dados" => $organFitoDAO->dados());
        $resOS = json_encode($dados);
        return $resOS;
             
    }
    
    public function dadosParada() {

        $paradaDAO = new ParadaDAO();

        $dados = array("dados"=>$paradaDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
     public function dadosRFuncaoAtivPar() {

        $rFuncaoAtivParDAO = new RFuncaoAtivParDAO();

        $dados = array("dados"=>$rFuncaoAtivParDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosROSAtiv() {
        
        $rOSAtivDAO = new ROSAtivDAO();

        $dados = array("dados"=>$rOSAtivDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;

    }
    
    public function dadosROCAFito() {

        $rOCAFitoDAO = new ROCAFitoDAO();

        $dados = array("dados"=>$rOCAFitoDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosTalhao() {
      
        $talhaoDAO = new TalhaoDAO();

        $dados = array("dados"=>$talhaoDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosTipoApont() {
      
        $tipoApontDAO = new TipoApontDAO();

        $dados = array("dados"=>$tipoApontDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
    public function dadosTurma() {
        
        $turmaDAO = new TurmaDAO();
        
        $dados = array("dados"=>$turmaDAO->dados());
        $json_str = json_encode($dados);

        return $json_str;
        
    }
    
}
