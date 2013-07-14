<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends CI_Controller {

	public function index(){
		$this->load->model('Tag');
		
		$data["tags"] = $this->Tag->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/tags/report',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function phrases($tag_id){
		$this->load->model('PhraseTag');
		$this->load->model('Phrase');
		$this->load->model('Tag');
		
		$phrases = $this->PhraseTag->report("tag_id = $tag_id");
		$data["phrases"] = array();
		
		if($phrases) foreach ($phrases as $phrase) {
			$data["phrases"][$phrase->id]=$phrase;
			$data["phrases"][$phrase->id]->phrase_id = $this->Phrase->fetch("$phrase->phrase_id");
			$data["phrases"][$phrase->id]->tag_id = $this->Tag->fetch("$phrase->tag_id");			
		}

		$this->load->view('templates/admin_header');
		$this->load->view('admin/tags/phrases',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function add(){
		$this->load->view('templates/admin_header');
		
		if($this->input->post()){
			$this->load->model('Tag');
			
			$tag = array('keyword' => $this->input->post("keyword"));
			
			$id = $this->Tag->insert($tag);
			
			$data["variable"] = $this->Tag->fetch($id);
			
			$data["message"] = "<strong>¡Registro Exitoso!</strong> La etiqueta ha sido registrada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			$data["variable"] = false;
		}
		
		$this->load->view('admin/tags/form',$data);
		
		$this->load->view('templates/admin_footer');
	}
	
	public function delete($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Tag');
		
		if($id){
			$tag = $this->Tag->fetch($id);
			
			if($tag){
				$this->Tag->delete($tag);
				
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
		
		$data["tags"] = $this->Tag->report("id > 0");
		$this->load->view('admin/tags/report', $data);
		
		$this->load->view('templates/admin_footer');
	}
}
?>