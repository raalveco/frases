<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index(){
		$this->load->model('Page');
		
		$data["pages"] = $this->Page->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/pages/report',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function add(){
		$this->load->view('templates/admin_header');
		
		if($this->input->post()){
			$this->load->model('Page');
			
			$page = array('code' => $this->input->post("code"), 'title' => $this->input->post("title"), 'content' => $this->input->post("content"));
			
			$id = $this->Page->insert($page);
			
			$data["variable"] = $this->Page->fetch($id);
			
			$data["message"] = "<strong>¡Registro Exitoso!</strong> La Página ha sido registrada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			$data["variable"] = false;
		}
		
		$this->load->view('admin/pages/form',$data);
		
		$this->load->view('templates/admin_footer');
	}
	
	public function edit($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Page');
		
		if($this->input->post()){
			$page = $this->Page->fetch($this->input->post("id"));
			
			$page->code = $this->input->post("code");
			$page->title = $this->input->post("title");
			$page->content = $this->input->post("content");
			
			$this->Page->update($page);
			
			$data["variable"] = $page;
			$data["message"] = "<strong>¡Actualización Exitosa!</strong> La variable de configuración ha sido actualizada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			if($id){
				$page = $this->Page->fetch($id);
				
				if($page){
					$data["variable"] = $page;	
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
		
		$this->load->view('admin/pages/form',$data);
		
		$this->load->view('templates/admin_footer');
	}

	public function delete($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Page');
		
		if($id){
			$page = $this->Page->fetch($id);
			
			if($page){
				$this->Page->delete($page);
				
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
		
		$data["pages"] = $this->Page->report("id > 0");
		$this->load->view('admin/pages/report', $data);
		
		$this->load->view('templates/admin_footer');
	}
}
?>