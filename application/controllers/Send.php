<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Mod_surat','Mod_helper','Mod_master']);
	}

	public function index()
	{
		$data = array(
			'title' => "E-Arsip",
			'send' => $this->Mod_surat->read_send(),
			'disposisi' => $this->Mod_master->get_disposisi(),
		);

		$this->load->view('tmp_site/index', $data);
		$this->load->view('tmp_site/nav');
		$this->load->view('tmp_site/sidebar');
		$this->load->view('send/read');
		$this->load->view('tmp_site/footer');
	}

	public function update()
	{
		$id = $this->uri->segment(3);
		$data = array(
			'title' => "E-Arsip",
			'views' => $this->Mod_surat->views($id)->row_array(),
		);

		$this->load->view('tmp_site/index', $data);
		$this->load->view('tmp_site/nav');
		$this->load->view('tmp_site/sidebar');
		$this->load->view('send/update');
		$this->load->view('tmp_site/footer');
	}

	public function detail()
	{
		$id = $this->uri->segment(3);
		$data = array(
			'title' => "E-Arsip",
			'views' => $this->Mod_surat->views($id)->row_array(),
		);

		$this->load->view('tmp_site/index', $data);
		$this->load->view('tmp_site/nav');
		$this->load->view('tmp_site/sidebar');
		$this->load->view('send/detail');
		$this->load->view('tmp_site/footer');
	}

	public function add()
	{
		if(isset($_POST['submit'])){
			$tanggal 	= $this->input->post('tanggal');
			$nomor 		= $this->input->post('nomor');
			$pengirim	= $this->input->post('pengirim');
			$tertuju	= $this->input->post('tertuju');
			$alamat 	= $this->input->post('alamat');
			$perihal 	= $this->input->post('perihal');
			$berkas		= $_FILES['berkas']['name'];
			$disposisi 	= $this->input->post('disposisi');
			$isi 		= $this->input->post('isi_disposisi');

			$config['upload_path'] 		= './media/suratkeluar/';
			$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx|xls|xlsx|rar|zip|tar';
			$config['max_size']  		= 2000;
			$config['max_width']  		= 1024;
			$config['max_height']  		= 768;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('berkas')){
				 echo "<script> alert('Maaf, File Gagal Di Upload.') </script>"; die(redirect('inbox','refresh'));
			}
			else{
				$data = array('upload_data' => $this->upload->data());
				echo "success";
			}

			$data = array(
				'tanggal' 		=> $tanggal,
				'nomor' 		=> $nomor,
				'pengirim' 		=> $pengirim,
				'perihal' 		=> $perihal,
				'tertuju'		=> $tertuju,
				'alamat' 		=> $alamat,
				'berkas' 		=> $berkas,
				'disposisi' 	=> $disposisi,
				'isi_disposisi' => $isi
			);

			$this->Mod_surat->add_send($data);
			redirect('Send');
		}
	}

	public function update_send()
	{
		if(isset($_POST['submit'])){
			$id 		= $this->input->post('id');
			$tanggal 	= $this->input->post('tanggal');
			$nomor 		= $this->input->post('nomor');
			$pengirim	= $this->input->post('pengirim');
			$tertuju	= $this->input->post('tertuju');
			$alamat 	= $this->input->post('alamat');
			$perihal 	= $this->input->post('perihal');
			$berkas		= $this->input->post('berkas');
			$disposisi 	= $this->input->post('disposisi');
			$isi 		= $this->input->post('isi_disposisi');

			$data = array(
				'id'			=> $id,
				'tanggal' 		=> $tanggal,
				'nomor' 		=> $nomor,
				'pengirim' 		=> $pengirim,
				'perihal' 		=> $perihal,
				'tertuju'		=> $tertuju,
				'alamat' 		=> $alamat,
				'berkas' 		=> $berkas,
				'disposisi' 	=> $disposisi,
				'isi_disposisi' => $isi
			);

			$this->db->where('id', $id);
			$this->Mod_surat->update_send($data);
			redirect('Send');
		}
	}

	public function delete()
	{
		$id = $this->uri->segment(3);
		$this->Mod_surat->delete_send($id, 'surat_keluar');
		redirect('Send');
	}

}

/* End of file Send.php */
/* Location: ./application/controllers/Send.php */