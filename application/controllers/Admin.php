<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
  	function __construct()
  	{
  		parent::__construct();
 		$this->usuario = $this->session->userdata("user");
		if(!$this->usuario){
			redirect('dashboard');
		}
		if($this->usuario->nivel!=3){
			redirect('dashboard');
		}
		$this->load->model('msuperadmin');
		$this->load->model('musuario');
		$this->load->model('mescuela');
		$this->load->model('mevento');
		$this->load->model('mantena');
		$this->load->library('form_validation');
  	}
	public function index(){
		$usuario = $this->usuario;
		$contadorAll = $this->msuperadmin->countAll();
    $antenas = $this->mantena->getAllAntenas();

		$data = array("title"=>"Admin Dashboard");
		$data["name"] = $usuario->nombre." ".$usuario->appat;
		$data["contador"] = $contadorAll;
    $data["antenas"] = $antenas;

		$this->load->view("headers/vheadersadmin",$data);
		$this->load->view("SuperAdmin/vdashboard");
        $this->load->view('footers/vfooter');
	}
	public function antenas_index(){
		$usuario = $this->usuario;
		$antenas = $this->mantena->getAllAntenas();

		$data = array("title"=>"Super Admin Dashboard");
		$data["name"] = $usuario->nombre." ".$usuario->appat;
		$data["antenas"] = $antenas;
		$this->load->view("headers/vheadersadmin",$data);
		$this->load->view('SuperAdmin/vlistaantenas');
	}
	public function antenas_crear(){
		$usuario = $this->usuario;

		$data = array("title"=>"Admin Dashboard");
    $data["name"] = $usuario->nombre." ".$usuario->appat;

		$this->load->view("headers/vheadersadmin",$data);
		$this->load->view('SuperAdmin/vformantena');
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
    $this->load->view('headers/vheadersadmin',$data);
    $this->load->view('SuperAdmin/vEstadisticas');
    $this->load->view('footers/vfooter');
}
	public function usuarios(){
		$usuario = $this->usuario;

		$usuarios = $this->msuperadmin->getUsuarios();

		$data = array("title"=>"Super Admin Dashboard");
	  $data["name"] = $usuario->nombre." ".$usuario->appat;
		$data["usuarios"] = $usuarios;

		$this->load->view("headers/vheadersadmin",$data);
		$this->load->view('SuperAdmin/vlistausuarios');
        $this->load->view('footers/vfooter');
	}
	public function ajax_crear_antena(){
		$respuesta = Array();



		if(!$this->input->post()){
			$respuesta["codigo"] = 1;
			$respuesta["respuesta"] = "Sin parametros";
		}
		else{
			//Validaciones de lo que llega del formulario
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('lat', 'Latitud', 'required');
			$this->form_validation->set_rules('lon', 'Longitud', 'required');

			$this->form_validation->set_data($this->input->post());

			$validate = $this->form_validation->run();
			if(!$validate){
				$respuesta["codigo"] = 2;
				$respuesta["respuesta"] = "Te hace falta llenar algunos campos";
				$respuesta["errores"] = validation_errors();
			}else{
				$r = $this->input->post();
				$pass = true;
				$respuesta["errores"] = "";
				if($this->mantena->exist($r["nombre"])){
					$pass = false;
					$respuesta["errores"] = $respuesta["errores"]."<br><p>Ya existe esta antena</p>";
				}
				else{
					$antena = Array(
						"nombre"		=> $r["nombre"],
						"lat"	=> $r["lat"],
						"lon"	=> $r["lon"],
					);
					$result = $this->mantena->create($antena);
					if($result){
						$respuesta["codigo"] = 0;
						$respuesta["respuesta"] = "Sin errores";
						$respuesta["errores"] = Array();
					}
					else{
						$respuesta["codigo"] = 3;
						$respuesta["respuesta"] = "No se puede crear la antena";
						$respuesta["errores"] = "<p>No se pudo crear la antena :(</p>";
					}
				}
			}
		}
   		header('Content-Type: application/json');
		echo json_encode($respuesta);
	}
}
