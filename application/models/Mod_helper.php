<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mod_helper extends CI_Model {

	public function sekolah(){
		$sekolah = $this->db->get('tb_sekolah');
		return $sekolah->result();
	}

	public function jurusan(){
		$jurusan = $this->db->get('tb_jurusan');
		return $jurusan->result();
	}

	public function pelajaran(){
		$pelajaran = $this->db->get('tb_pelajaran');
		return $pelajaran->result();
	}

}

/* End of file Mod_helper.php */
/* Location: ./application/models/Mod_helper.php */