<?php
class Index extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->library('session');
        $usuario = $this->session->userdata("user");
        if($usuario){
            redirect('Dashboard');
        }
    }

    public function index(){
        $this->load->view('vindex');
    }
}
?>
