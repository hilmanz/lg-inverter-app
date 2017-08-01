<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mymodel extends CI_Model {
	function __construct() {
        $this->postTable = 'content_management';
        $this->postIklan = 'iklan';
    }

    	
	public function InsertData($tabelName,$data){
		$res = $this->db->insert($tabelName,$data);
		return $res;
	}
	
	public function UpdateData($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
	
	public function StatusInactive($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}		
	
	public function DeleteData($tabelName,$data,$where){
		$res = $this->db->update($tabelName,$data,$where);
		return $res;
	}
	
		
	function get_registration($where)
		{
			$this->load->database();
			$query=$this->db->query("select * from registration $where");			
			return $query->result();
		}
		
	function get_page($dated,$page)
	{
		$this->load->database();
		$query=$this->db->query("select * from timeline where event_finish >= '".$dated."' and view ='".$page."'");			
		
		return $query->result();
	}
	
	
	
	function get_view($dated)
	{
		$this->load->database();
		$query=$this->db->query("select * from timeline where event_finish >= '".$dated."' and  event_start <= '".$dated."' ");	
		
		return $query->result();
	}
	
	function validasi()
		{
			$this->db->where('username',
			$this->input->post('username'));
			$this->db->where('password',
			$this->encryptIt($this->input->post('password')));
			$ambil = $this->db->get('user');
			
			//echo $this->input->post('username')."|".$this->input->post('password');
			//exit;
			
			if($ambil->num_rows() == 1)
			{
				return true;
				//exit;
			}
		}
		
	function encryptIt( $q ) {
		$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
		$qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
		return( $qEncoded );
	}
		
	function getCombos($table,$id) {
		$data = array();
		$options = array('state_id' => $id);
		$Q = $this->db->getwhere($table,$options,1);
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row){
					$data[] = $row;
				}
		}	
		$Q->free_result();
		return $data;	
	}
		
	function getCombo($table) {
		$data = array();
		$Q = $this->db->get($table);
		if ($Q->num_rows() > 0) {
			foreach ($Q->result_array() as $row){
					$data[] = $row;
				}
		}	
		$Q->free_result();
		return $data;	
	}
	
	function get_fb($email){

		$this->load->database();

		$query=$this->db->query("select * from register_fb where email='{$email}'");			

		return $query->result();

	}
	
	function get_total_fb(){

		$this->load->database();

		$query=$this->db->query("select count(*)as total from register_fb");			
		
		$result = $query->result_array();
		return $result;

	}

	function get_search() {
	  $match = $this->input->get(‘search’);
	  $this->db->like('nama',$match);
	  $query = $this->db->get('content_management');
	  return $query->result();
	}	 

	function get_status() {
	  $match = $this->input->post('status');
	  $this->db->like('n_status',$match);
	  $query = $this->db->get('content_management');
	  return $query->result();
	}
	
	function get_status1() {
	  $match = $this->input->post('status');
	  if($match=='1'){
		  $this->db->like('n_status',$cari);
	  }
	  $this->db->like('n_status',$match);
	  $query = $this->db->get('content_management');
	  return $query->result();
	}
}