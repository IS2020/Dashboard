<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->usuario = $this->session->userdata("user");
        if(!$this->usuario){
            redirect('login');
        }
        if($this->usuario->nivel==3)
            redirect('Admin');
        $this->load->model('musuario');
        $this->load->model('mantena');
    }
    public function index()
    {
        $usuario = $this->usuario;

        $antenas = $this->mantena->getAllAntenas();
        $datos['title'] = "Dashboard";
        $datos["name"] = $usuario->nombre." ".$usuario->appat;
        $datos['antenas'] = $antenas;
        $this->load->view('headers/vheaderuser',$datos);
        $this->load->view('Guest/vdashboard');
        $this->load->view('footers/vfooter');
    }
    public function antena_estadisticas($idAntena){
      $usuario = $this->usuario;
      if(!$this->mantena->existById($idAntena)){
        redirect("Admin");
      }
      $nombreAntena = $this->mantena->getNombre($idAntena);
      $data = array("title"=>"Admin Dashboard");
      $data["name"] = $usuario->nombre." ".$usuario->appat;
      $data["nombreAntena"] = $nombreAntena;

      $reportes = $this->mantena->getReportes($idAntena);
      foreach ($reportes as $r) {
        $strJsonFileContents = file_get_contents($r->filepath);
        // Convert to array
        $array = json_decode($strJsonFileContents, true);
        $r->ts = $array["Timestamp"];
        $r->values = $array["Values"];
      }
      $data["reportes"] = $reportes;
      $this->load->view('headers/vheaderuser',$data);
      $this->load->view('SuperAdmin/vEstadisticas');
      $this->load->view('footers/vfooter');
  }
}
