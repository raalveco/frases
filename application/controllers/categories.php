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
}
?>