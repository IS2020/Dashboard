<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class DocMarcoDes extends CI_Controller
{
	
	public function index()
	{
		$this->load->view('headers/vheaderDoc',array("title"=>"gesEvento"));
		$this->load->view('Documentacion/vDocMarcoDes');
		$this->load->view('footers/vfooter');
	}
}