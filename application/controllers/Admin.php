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
		$name = $this->musuario->getName($usuario->id_usuario);

		$data = array("title"=>"Admin Dashboard");
		$data["name"] = $name["nombre"]." ".$name["appat"];
		$data["contador"] = $contadorAll;
    $data["antenas"] = $antenas;

		$this->load->view("headers/vheadersadmin",$data);
		$this->load->view("SuperAdmin/vdashboard");
        $this->load->view('footers/vfooter');
	}
	public function eventos_index(){
		$usuario = $this->usuario;
		$name = $this->musuario->getName($usuario->id_usuario);
		$eventos = $this->mantena->getAllAntenas();

		$data = array("title"=>"Super Admin Dashboard");
		$data["name"] = $name["nombre"]." ".$name["appat"];
		$data["eventos"] = $eventos;

		$this->load->view("headers/vheadersadmin",$data);
		$this->load->view('SuperAdmin/vlistaeventos');
		return;
	}
	public function antenas_crear(){
		$usuario = $this->usuario;
		$name = $this->musuario->getName($usuario->id_usuario);

		$data = array("title"=>"Admin Dashboard");
		$data["name"] = $name["nombre"]." ".$name["appat"];

		$this->load->view("headers/vheadersadmin",$data);
		$this->load->view('SuperAdmin/vformescuela');
    $this->load->view('footers/vfooter');
	}
	public function usuarios(){
		$usuario = $this->usuario;
		$name = $this->musuario->getName($usuario->id_usuario);
		$usuarios = $this->msuperadmin->getUsuarios();

		$data = array("title"=>"Super Admin Dashboard");
		$data["name"] = $name["nombre"]." ".$name["appat"];
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
	public function borrarEscuela(){
		echo $this->mescuela->borrarEscuela(1);
	}
	public function ajax_delete_evento(){
		$respuesta = Array();
		if(!$this->input->post()){
			$respuesta["codigo"] = 1;
			$respuesta["respuesta"] = "Sin parametros";
		}else{
			$this->form_validation->set_rules('evento', 'Evento', 'required');
			$this->form_validation->set_data($this->input->post());
			if(!$this->form_validation->run()){
				$respuesta["codigo"] = 2;
				$respuesta["respuesta"] = "Falta el id de la escuela";
				$respuesta["errores"] = validation_errors();
			}else{
				$evento = $this->input->post()["evento"];
				if($this->mevento->deleteEvento($evento)){
					$respuesta["codigo"] = 0;
					$respuesta["respuesta"] = "Evento borrado con exito";
					$respuesta["errores"] = Array();
				}else{
					$respuesta["codigo"] = 1;
					$respuesta["respuesta"] = "No se pudo borrar el evento";
					$respuesta["errores"] = Array("No se pudo borrar el evento");
				}
			}
		}
   	  header('Content-Type: application/json');
 	  echo json_encode($respuesta);
	}
}
