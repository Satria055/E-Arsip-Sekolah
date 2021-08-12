<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_surat extends CI_Model {

	public function add_inbox($data){
		$this->db->insert('surat_masuk', $data);
		return true;
	}

	public function update_inbox($data){
		$this->db->update('surat_masuk', $data);
		return true;
	}

	public function read_inbox(){
		$inbox = $this->db->order_by('id', 'DESC');
		$inbox = $this->db->get('surat_masuk');
		return $inbox->result();
	}

	public function view($id){
		return $this->db->get_where('surat_masuk', array('id' => $id));
	}

	public function delete_inbox($id){
		return $this->db->delete('surat_masuk', array('id' => $id));
	}

	// Model untuk surat keluar

	public function add_send($data){
		$this->db->insert('surat_keluar', $data);
		return true;
	}

	public function update_send($data){
		$this->db->update('surat_keluar', $data);
		return true;
	}

	public function read_send(){
		$send = $this->db->order_by('id', 'DESC');
		$send = $this->db->get('surat_keluar');
		return $send->result();
	}

	public function views($id){
		return $this->db->get_where('surat_keluar', array('id' => $id));
	}

	public function delete_send($id){
		return $this->db->delete('surat_keluar', array('id' => $id));
	}




	public function count_inbox()
	{
		$query = $this->db->query("SELECT * FROM surat_masuk");
        $inbox = $query->num_rows();
        return $inbox;
	}

	public function count_send()
	{
		$query = $this->db->query("SELECT * FROM surat_keluar");
        $send = $query->num_rows();
        return $send;
	}

}

/* End of file Mod_surat.php */
/* Location: ./application/models/Mod_surat.php */