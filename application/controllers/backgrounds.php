<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backgrounds extends CI_Controller {

	public function index(){
		$this->load->model('Background');
		
		$data["backgrounds"] = $this->Background->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/backgrounds/report',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function add(){
		$this->load->view('templates/admin_header');
		
		if($this->input->post()){
			$this->load->model('Background');
						
			$config['upload_path'] = './backgrounds/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['encrypt_name'] = true;
			//config['max_size']	= '100';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
	
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload("image"))
			{
				$error = array('error' => $this->upload->display_errors());
				$data["variable"] = false;
				$data["message"] = "<strong>¡Error en la carga del archivo! </strong> ".trim($error["error"])."";
				$this->load->view('admin/alerts/error',$data);
				$this->load->view('admin/backgrounds/form',$data);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				
				if($data["upload_data"]["image_width"]==1024 && $data["upload_data"]["image_height"]==768){
					$background = array('image' => $data["upload_data"]["file_name"]);
					$id = $this->Background->insert($background);
					
					///////////////Image thumb/////////////////////////////
					$config2['image_library'] = 'gd2';
					$config2['source_image']	= './backgrounds/'.$data["upload_data"]["file_name"];
					$config2['maintain_ratio'] = TRUE;
					$config2['create_thumb'] = TRUE;
					$config2['width']	 = 80;
					$config2['height']	= 60;
					$config2['new_image'] = './backgrounds/thumbnails/'.$data["upload_data"]["file_name"];
					$this->load->library('image_lib', $config2); 
					$this->image_lib->resize(); 
					///////////////////////////////////////////////////
					
					$data["message"] = "<strong>¡Registro Exitoso!</strong> El fondo ha sido registrado correctamente.";
					$this->load->view('admin/alerts/success',$data);
					$data["variable"] = $this->Background->fetch($id);
					$data["backgrounds"] = $this->Background->report("id > 0");
					$this->load->view('admin/backgrounds/report',$data);	
				}
				else{
					$data["variable"] = false;
					$data["message"] = "<strong>¡Error en la carga del archivo! </strong><br>La imagen debe tener una resolución de 1024 x 768";
					$this->load->view('admin/alerts/error',$data);
					$this->load->view('admin/backgrounds/form',$data);
					
					@unlink('./backgrounds/'.$data["upload_data"]["file_name"]);
				}
			}			
			
		}
		else{
			$data["variable"] = false;
			$this->load->view('admin/backgrounds/form',$data);
		}
		
		$this->load->view('templates/admin_footer');
	}
	

	public function delete($id = false){
		$this->load->view('templates/admin_header');
		$this->load->model('Background');
		
		if($id){
			$background = $this->Background->fetch($id);
			
			if($background){
				@unlink("backgrounds/".$background->image);
				$strTemp = explode(".",$background->image);
				@unlink("backgrounds/thumbnails/".$strTemp[0]."_thumb.".$strTemp[1]);
				$this->Background->delete($background);
				$data["message"] = "<strong>¡Registro Eliminado!</strong> El registro ha sido eliminado correctamente.";
				$this->load->view('admin/alerts/success',$data);
			}	
			else{
				$data["message"] = "<strong>¡Error!</strong> El registro que deseas eliminar, <b>NO EXISTE</b>.";
				$this->load->view('admin/alerts/error',$data);
			}
		}
		else{
			$data["message"] = "<strong>¡Error!</strong> El registro que deseas eliminar, <b>NO EXISTE</b>.";
			$this->load->view('admin/alerts/error',$data);
		}
		
		$data["backgrounds"] = $this->Background->report("id > 0");
		$this->load->view('admin/backgrounds/report', $data);
		
		$this->load->view('templates/admin_footer');
	}
}
?>