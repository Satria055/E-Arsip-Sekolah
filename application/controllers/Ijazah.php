<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ijazah extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model(['Mod_helper','Mod_ijazah']);
	}

	public function index()
	{
		$data = array(
			'title' => "E-Arsip",
			'ijazah' => $this->Mod_ijazah->read(),
		);

		$this->load->view('tmp_site/index', $data);
		$this->load->view('tmp_site/nav');
		$this->load->view('tmp_site/sidebar');
		$this->load->view('ijazah/read');
		$this->load->view('tmp_site/footer');
	}

	public function update()
	{
		$id = $this->uri->segment(3);
		$data = array(
			'title' => "E-Arsip",
			'detail' => $this->Mod_ijazah->detail($id)->row_array(),
		);

		$this->load->view('tmp_site/index', $data);
		$this->load->view('tmp_site/nav');
		$this->load->view('tmp_site/sidebar');
		$this->load->view('ijazah/update');
		$this->load->view('tmp_site/footer');
	}

	public function detail()
	{
		$id = $this->uri->segment(3);
		$data = array(
			'title' => "E-Arsip",
			'detail' => $this->Mod_ijazah->detail($id)->row_array(),
		);

		$this->load->view('tmp_site/index', $data);
		$this->load->view('tmp_site/nav');
		$this->load->view('tmp_site/sidebar');
		$this->load->view('ijazah/detail');
		$this->load->view('tmp_site/footer');
	}

	public function add()
	{
		if(isset($_POST['submit'])){
			$nama_lengkap	= $this->input->post('nama_lengkap');
			$tempat_lahir  	= $this->input->post('tempat_lahir');
			$tgl_lahir 		= $this->input->post('tgl_lahir');
			$no_un 			= $this->input->post('no_un');
			$no_ijazah 		= $this->input->post('no_ijazah');
			$tahun_lulus	= $this->input->post('tahun_lulus');
			$berkas 		= $_FILES['berkas']['name'];
			$berkas2 		= $_FILES['berkas2']['name'];

			$config['upload_path'] 		= './media/ijazah/';
			$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx|xls|xlsx|rar|zip|tar';
			$config['max_size']  		= 2000;
			$config['max_width']  		= 1024;
			$config['max_height']  		= 768;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('berkas')){
				 echo "<script> alert('Maaf, File Gagal Di Upload.') </script>"; die(redirect('Ijazah','refresh'));
			}
			else{
				$data = array('upload_data' => $this->upload->data());
				echo "success";
			}


			if ( ! $this->upload->do_upload('berkas2')){
				 echo "<script> alert('Maaf, File Gagal Di Upload.') </script>"; die(redirect('Ijazah','refresh'));
			}
			else{
				$data = array('upload_data' => $this->upload->data());
				echo "success";
			}

			$data = array(
				'nama_lengkap' 	=> $nama_lengkap,
				'tempat_lahir' 	=> $tempat_lahir,
				'tgl_lahir' 	=> $tgl_lahir,
				'no_un' 		=> $no_un,
				'no_ijazah'	 	=> $no_ijazah,
				'tahun_lulus' 	=> $tahun_lulus,
				'berkas'		=> $berkas,
				'skhun'			=> $berkas2
			);

			$this->Mod_ijazah->add($data);
			redirect('Ijazah');
		}
	}

	public function update_ijazah()
	{
		if(isset($_POST['submit'])){
			$id 			= $this->input->post('id');
			$nama_lengkap	= $this->input->post('nama_lengkap');
			$tempat_lahir  	= $this->input->post('tempat_lahir');
			$tgl_lahir 		= $this->input->post('tgl_lahir');
			$no_un 			= $this->input->post('no_un');
			$no_ijazah 		= $this->input->post('no_ijazah');
			$tahun_lulus	= $this->input->post('tahun_lulus');
			$berkas 		= $this->input->post('berkas');
			$berkas2 		= $this->input->post('berkas2');

			$data = array(
				'id'			=> $id,
				'nama_lengkap' 	=> $nama_lengkap,
				'tempat_lahir' 	=> $tempat_lahir,
				'tgl_lahir' 	=> $tgl_lahir,
				'no_un' 		=> $no_un,
				'no_ijazah'	 	=> $no_ijazah,
				'tahun_lulus' 	=> $tahun_lulus,
				'berkas'		=> $berkas,
				'skhun'			=> $berkas2
			);
			$this->db->where('id', $id);
			$this->Mod_ijazah->update($data);
			redirect('Ijazah');
		}
	}

	public function delete()
	{
		$id = $this->uri->segment(3);
		$this->Mod_ijazah->delete($id, 'ijazah');
		redirect('Ijazah');
	}


}

/* End of file Ijazah.php */
/* Location: ./application/controllers/Ijazah.php */