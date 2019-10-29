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
  public function create($antena){
      $antena["api-key"] = password_hash(time(), PASSWORD_DEFAULT);
      $result = $this->db->insert('Antenas', $antena);
      return $result;

  }
    public function getAllAntenas(){
        $q = "SELECT * from Antenas";
        return $this->db->query($q)->result();
    }
}
