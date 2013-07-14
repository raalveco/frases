<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phrases extends CI_Controller {

	public function index(){
		$this->load->model('Phrase');
		$this->load->model('Background');
		$this->load->model('Font');
		
		$phrases = $this->Phrase->report("id > 0");
		$data["phrases"] = array();
		
		if($phrases) foreach($phrases as $phrase){
			$data["phrases"][$phrase->id] = $phrase;
			//Consultar relaciones 1:N con otras tablas
			$data["phrases"][$phrase->id]->background_id = $this->Background->fetch($phrase->background_id);
			$data["phrases"][$phrase->id]->font_id = $this->Font->fetch($phrase->font_id);
		}
		
		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases/report',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function visits($phrase_id){
		$this->load->model("Visit");
		$this->load->model("Phrase");
		
		$visits = $this->Visit->report("phrase_id = $phrase_id");
		$data["visits"] = array();
		
		if($visits) foreach($visits as $visit){
			$data["visits"][$visit->id]=$visit;
			//Consultar relaciones 1:N con otras tablas
			$data["visits"][$visit->id]->phrase_id = $this->Phrase->fetch($visit->phrase_id);
		}
		
		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases/visits',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function tags($phrase_id){
		$this->load->model("PhraseTag");
		$this->load->model("Phrase");
		$this->load->model("Tag");
		
		$tags = $this->PhraseTag->report("phrase_id = $phrase_id");
		$data["tags"] = array();
		
		if($tags) foreach ($tags as $tag) {
			$data["tags"][$tag->id]=$tag;
			//Consultar relaciobes 1:N con otras tablas
			$data["tags"][$tag->id]->phrase_id = $this->Phrase->fetch($tag->phrase_id);
			$data["tags"][$tag->id]->tag_id = $this->Tag->fetch($tag->tag_id);			
		}		
	
		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases/tags',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function posts($phrase_id){
		$this->load->model("Post");
		$this->load->model("User");
		$this->load->model("Phrase");
		
		$posts = $this->Post->report("phrase_id = $phrase_id");
		$data["posts"] = array();
		
		if($posts) foreach($posts as $post){
			$data["posts"][$post->id] = $post;
			//Consultar relaciobes 1:N con otras tablas
			$data["posts"][$post->id]->user_id = $this->User->fetch($post->user_id);
			$data["posts"][$post->id]->phrase_id = $this->Phrase->fetch($post->phrase_id);
		}
	
		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases/posts',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function categories($phrase_id){
		$this->load->model("PhraseCategory");
		$this->load->model("Phrase");
		$this->load->model("Category");
		
		$categories = $this->PhraseCategory->report("phrase_id = $phrase_id");
		$data["categories"] = array();
		
		if($categories) foreach($categories as $category){
			$data["categories"][$category->id] = $category;
			//Consultar relaciobes 1:N con otras tablas
			$data["categories"][$category->id]->phrase_id = $this->Phrase->fetch($category->phrase_id);
			$data["categories"][$category->id]->category_id = $this->Category->fetch($category->category_id);
		}
	
		$this->load->view('templates/admin_header');
		$this->load->view('admin/phrases/categories',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function add(){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Background');
		$this->load->model('Font');
		
		if($this->input->post()){
			$this->load->model('Phrase');
			
			$phrase = array('phrase' => $this->input->post("phrase"), 'from' => $this->input->post("from"), 'to' => $this->input->post("to"), 'background_id' => 1, 'font_id' => $this->input->post("font"));
			
			$id = $this->Phrase->insert($phrase);
			
			$data["variable"] = $this->Phrase->fetch($id);
			
			$data["message"] = "<strong>¡Registro Exitoso!</strong> La Página ha sido registrada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			$data["variable"] = false;
		}
		
		$data["backgrounds"] = $this->Background->report("id > 0");
		$data["fonts"] = $this->Font->report("id > 0");
		
		$this->load->view('admin/phrases/form',$data);
		
		$this->load->view('templates/admin_footer');
	}
	
	public function edit($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Phrase');
		$this->load->model('Background');
		$this->load->model('Font');
		
		if($this->input->post()){
			$phrase = $this->Phrase->fetch($this->input->post("id"));
			
			$phrase->phrase = $this->input->post("phrase");
			$phrase->from = $this->input->post("from");
			$phrase->to = $this->input->post("to");
			
			$phrase->background_id = 1;
			$phrase->font_id = $this->input->post("font");
			
			$this->Phrase->update($phrase);
			
			$data["variable"] = $phrase;
			$data["message"] = "<strong>¡Actualización Exitosa!</strong> La variable de configuración ha sido actualizada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			if($id){
				$page = $this->Phrase->fetch($id);
				
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
		
		$data["backgrounds"] = $this->Background->report("id > 0");
		$data["fonts"] = $this->Font->report("id > 0");
		
		$this->load->view('admin/phrases/form',$data);
		
		$this->load->view('templates/admin_footer');
	}

	public function delete($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Phrase');
		$this->load->model('Background');
		$this->load->model('Font');
		
		if($id){
			$page = $this->Phrase->fetch($id);
			
			if($page){
				$this->Phrase->delete($page);
				
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
		$data["fonts"] = $this->Font->report("id > 0");
		
		$phrases = $this->Phrase->report("id > 0");
		$data["phrases"] = array();
		
		if($phrases) foreach($phrases as $phrase){
			$data["phrases"][$phrase->id] = $phrase;
			//Consultar relaciones 1:N con otras tablas
			$data["phrases"][$phrase->id]->background_id = $this->Background->fetch($phrase->background_id);
			$data["phrases"][$phrase->id]->font_id = $this->Font->fetch($phrase->font_id);
		}
		
		$this->load->view('admin/phrases/report', $data);
		
		$this->load->view('templates/admin_footer');
	}

	public function backgrounds(){
		$this->load->model('Background');
		
		$backgrounds = $this->Background->report("id > 0","id DESC",30);
		
		if($backgrounds) foreach($backgrounds as $background){
			echo '<img src="'.$background->image.'" />';
		}
	} 
}
?>