<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Msuperadmin extends CI_Model{
    public function crearEscuela($datos_escuela,$datos_admin){
      $result = $this->db->insert("Escuelas",$datos_escuela);
      if(!$result){
        return false;
      }
      $id_escuela = $this->db->insert_id();
      $result = $this->crearAdministrador($id_escuela,$datos_admin);
      return $result;
    }
    public function crearAdministrador($id_escuela,$datos_admin){
      $user_admin = Array(
                      "username"      => "Admin_".$datos_admin["username"],
                      "nombre"        => $datos_admin["nombre"],
                      "appat"         => "",
                      "apmat"         => "",
                      "correo"        => $datos_admin["correo"],
                      "password"      => password_hash($datos_admin["password"],PASSWORD_DEFAULT),
                      "nivel_permiso" => 2,
                      );
      $result = $this->db->insert("Usuarios",$user_admin);
      if(!$result)
        return false;
      $id_user = $this->db->insert_id();
      $admin = Array(
                  "usuario" =>$id_user,
                  "escuela" =>$id_escuela,
                );
      $result = $this->db->insert("Administradores",$admin);
      return $result;
    }
    public function countAll(){
      $usuarios = $this->db->query("select count(*) numero from Usuarios");
      $antenas= $this->db->query("select count(*) numero from Antenas");

      $data['usuarios'] = $usuarios->result()[0]->numero;
      $data['antenas'] = $antenas->result()[0]->numero;

      return $data;
       
    }
    public function getUsuarios(){
      $this->db->select('id_usuario,username,nombre,appat,apmat,correo');
      $this->db->from('Usuarios');
      return $this->db->get()->result();
    }
  
}