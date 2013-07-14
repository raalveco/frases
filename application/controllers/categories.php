<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function index(){
		$this->load->model('Category');
		
		$data["categories"] = $this->Category->report("id > 0","name ASC");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/categories/report',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function phrases($category_id){
		$this->load->model('PhraseCategory');
		$this->load->model('Phrase');
		$this->load->model('Background');
		$this->load->model('Font');
		
		$relations = $this->PhraseCategory->report("category_id = $category_id");
		
		$data["phrases"] = array();
		
		if($relations) foreach($relations as $relation){
			$data["phrases"][$relation->id] = $this->Phrase->fetch($relation->phrase_id);
			
			//Consultar relaciones 1:N con otras tablas
			$data["phrases"][$relation->id]->background_id = $this->Background->fetch($data["phrases"][$relation->id]->background_id);
			$data["phrases"][$relation->id]->font_id = $this->Font->fetch($data["phrases"][$relation->id]->font_id);
		}

		$this->load->view('templates/admin_header');
		$this->load->view('admin/categories/phrases',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function add(){
		$this->load->view('templates/admin_header');
		
		if($this->input->post()){
			$this->load->model('Category');
			
			$category = array('name' => $this->input->post("name"));
			
			$id = $this->Category->insert($category);
			
			$data["variable"] = $this->Category->fetch($id);
			
			$data["message"] = "<strong>¡Registro Exitoso!</strong> La categoria ha sido registrada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			$data["variable"] = false;
		}
		
		$this->load->view('admin/categories/form',$data);
		
		$this->load->view('templates/admin_footer');
	}
	
	public function edit($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Category');
		
		if($this->input->post()){
			$category = $this->Category->fetch($this->input->post("id"));
			
			$category->name = $this->input->post("name");
			
			$this->Category->update($category);
			
			$data["variable"] = $category;
			$data["message"] = "<strong>¡Actualización Exitosa!</strong> La categoria ha sido actualizada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			if($id){
				$category = $this->Category->fetch($id);
				
				if($category){
					$data["variable"] = $category;	
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
		
		$this->load->view('admin/categories/form',$data);
		
		$this->load->view('templates/admin_footer');
	}

	public function delete($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Category');
		
		if($id){
			$category = $this->Category->fetch($id);
			
			if($category){
				$this->Category->delete($category);
				
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
		
		$data["categories"] = $this->Category->report("id > 0");
		$this->load->view('admin/categories/report', $data);
		
		$this->load->view('templates/admin_footer');
	}
}
?>