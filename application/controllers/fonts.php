<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fonts extends CI_Controller {

	public function index(){
		$this->load->model('Font');
		
		$data["fonts"] = $this->Font->report("id > 0","name ASC");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/fonts/report',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function add(){
		$this->load->view('templates/admin_header');
		
		if($this->input->post()){
			$this->load->model('Font');
			
			$font = array('code' => $this->input->post("code"), 'name' => $this->input->post("name"));
			
			$id = $this->Font->insert($font);
			
			$data["variable"] = $this->Font->fetch($id);
			
			$data["message"] = "<strong>¡Registro Exitoso!</strong> La fuente ha sido registrada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			$data["variable"] = false;
		}
		
		$this->load->view('admin/fonts/form',$data);
		
		$this->load->view('templates/admin_footer');
	}

	public function edit($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Font');
		
		if($this->input->post()){
			$font = $this->Font->fetch($this->input->post("id"));
			
			$font->code = $this->input->post("code");
			$font->name = $this->input->post("name");
			
			$this->Font->update($font);
			
			$data["variable"] = $font;
			$data["message"] = "<strong>¡Actualización Exitosa!</strong> La fuente ha sido actualizada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			if($id){
				$font = $this->Font->fetch($id);
				
				if($font){
					$data["variable"] = $font;	
				}	
				else{
					$data["variable"] = false;
					
					$data["message"] = "<strong>¡Error!</strong> El registro que deseas modificar, <b>NO EXISTE</b>.";
					$this->load->view('admin/alerts/error',$data);
				}
			}
			else{
				$data["variable"] = false;
				
				$data["message"] = "<strong>¡Error!</strong> El registro que deseas modificar, <b>NO EXISTE</b>.";
				$this->load->view('admin/alerts/error',$data);
			}
		}
		
		$this->load->view('admin/fonts/form',$data);
		
		$this->load->view('templates/admin_footer');
	}

    public function delete($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Font');
		
		if($id){
			$font = $this->Font->fetch($id);
			
			if($font){
				$this->Font->delete($font);
				
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
		
		$data["fonts"] = $this->Font->report("id > 0");
		$this->load->view('admin/fonts/report', $data);
		
		$this->load->view('templates/admin_footer');
	}
}
?>