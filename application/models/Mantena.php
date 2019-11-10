<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mantena extends CI_Model{
  public function exist($nombre){
      $this->db->select('id_antena');
      $this->db->from('Antenas');
      $this->db->where('nombre',$nombre);
      $antena = $this->db->get()->result_array();
      if(!$antena)
          return false;
      return true;
  }
  public function existById($id){
      $this->db->select('id_antena');
      $this->db->from('Antenas');
      $this->db->where('id_antena',$id);
      $antena = $this->db->get()->result_array();
      if(!$antena)
          return false;
      return true;
  }
  public function create($antena){
      $antena["api-key"] = password_hash(time(), PASSWORD_DEFAULT);
      $result = $this->db->insert('Antenas', $antena);
      return $result;

  }
  public function getNombre($idAntena){
    $q = "SELECT nombre from Antenas where id_antena=".$idAntena;
    return $this->db->query($q)->result()[0]->nombre;
  }
    public function getAllAntenas(){
        $q = "SELECT * from Antenas";
        return $this->db->query($q)->result();
    }
    public function getReportes($id_antena){
      $q = "SELECT * from Reportes where id_antena=".$id_antena;
      return $this->db->query($q)->result();
    }
}
