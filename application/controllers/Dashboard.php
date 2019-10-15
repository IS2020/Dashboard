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
        $this->load->model('mevento');
        $this->load->model('musuario');
    }
    public function index()
    {
        $usuario = $this->usuario;
        $datos['title'] = "Dashboard";
        $datos['head'] =$this->musuario->getName($usuario->id_usuario);
        $datos['eventos'] = $this->mevento->infoPorEvento();
        $datos['my_events'] = $this->mevento->obtain_events_user($usuario->id_usuario);
        $this->load->view('headers/vheaderuser',$datos);
        $this->load->view('Guest/vdashboard');
        $this->load->view('footers/vfooter');
    }
    public function lista_eventos()
    {
        $datos = $this->mevento->infoPorEvento();
        return $datos;
    }
}
