<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configurations extends CI_Controller {

	public function index(){
		$this->load->model('Configuration');
		
		$data["configurations"] = $this->Configuration->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/configurations/report',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function add(){
		$this->load->view('templates/admin_header');
		
		if($this->input->post()){
			$this->load->model('Configuration');
			
			$configuration = array('code' => $this->input->post("code"), 'value' => $this->input->post("value"));
			
			$id = $this->Configuration->insert($configuration);
			
			$data["variable"] = $this->Configuration->fetch($id);
			
			$data["message"] = "<strong>¡Registro Exitoso!</strong> La variable de configuración ha sido registrada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			$data["variable"] = false;
		}
		
		$this->load->view('admin/configurations/form',$data);
		
		$this->load->view('templates/admin_footer');
	}
	
	public function edit($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Configuration');
		
		if($this->input->post()){
			$configuracion = $this->Configuration->fetch($this->input->post("id"));
			
			$configuracion->code = $this->input->post("code");
			$configuracion->value = $this->input->post("value");
			
			$this->Configuration->update($configuracion);
			
			$data["variable"] = $configuracion;
			$data["message"] = "<strong>¡Actualización Exitosa!</strong> La variable de configuración ha sido actualizada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			if($id){
				$configuracion = $this->Configuration->fetch($id);
				
				if($configuracion){
					$data["variable"] = $configuracion;	
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
		
		$this->load->view('admin/configurations/form',$data);
		
		$this->load->view('templates/admin_footer');
	}

	public function delete($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Configuration');
		
		if($id){
			$configuracion = $this->Configuration->fetch($id);
			
			if($configuracion){
				$this->Configuration->delete($configuracion);
				
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
		
		$data["configurations"] = $this->Configuration->report("id > 0");
		$this->load->view('admin/configurations/report', $data);
		
		$this->load->view('templates/admin_footer');
	}
}
?>