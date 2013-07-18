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
	
	private function renderPhrase($phrase_id, $background_id = false, $font_id = false){
		$this->load->model('Phrase');
		$this->load->model('Background');
		$this->load->model('Font');
		
		$phrase = $this->Phrase->fetch($phrase_id);
		
		if($background_id){
			$background = $this->Background->fetch($background_id);	
		}
		else{
			$background = $this->Background->fetch($phrase->background_id);
		}
		
		if($font_id){
			$font = $this->Font->fetch($font_id);
		}
		else{
			$font = $this->Font->fetch($phrase->font_id);	
		}
		
		$image = imagecreatefromjpeg("./backgrounds/".$background->image);
		
		$font = './fonts/'.$font->code;
		$font_size = 40;
		
		$name = sha1(date("YmdHis".rand(0, 10000))).".png";
		$tmp = "./backgrounds/watermark/".$name;
		imagepng($image,$tmp);
		$im = imagecreatefrompng($tmp);
		
		$words = explode(" ",strtoupper($phrase->phrase));
		
		$lines = array();
		$line = "";
		
		if($words) foreach($words as $word){
			if(strlen($line)+strlen($word)+1 <= 25){
				$line .= " ".$word;
			}
			else{
				$lines[] = $line;
				
				$line = $word;
			}
			
			$line = trim($line);
		}
		
		$lines[] = $line;
		
		if(count($lines) % 2 == 0){
			$n = count($lines) / 2 * - 70;
			$n += 35;
		}
		else{
			$n = (count($lines) - 1) / 2 * -70;
		}
		
		$white = imagecolorallocate($im, 255, 255, 255);
		$black = imagecolorallocate($im, 0, 0, 0);
		
		if($lines) foreach($lines as $line){
			$box = imagettfbbox($font_size, 0, $font, $line);
			$a = $box[0] + (imagesx($im) / 2) - ($box[4] / 2);
			$b = $box[1] + (imagesy($im) / 2) - ($box[5] / 2);
			imagettftext($im, $font_size, 0, $a+2, ($b+$n)+2, $black, $font, $line);
			imagettftext($im, $font_size, 0, $a, ($b+$n), $white, $font, $line);
			$n += 70;
		}
		
		$watermark = $this->Configuration->find_first("code = 'WATER_MARK'")->value;
		
		$box = imagettfbbox(20, 0, $font, $watermark);
		
		imagettftext($im, 20, 0, imagesx($im)-$box[2]-8, imagesy($im)-8, $black, $font, $watermark);
		imagettftext($im, 20, 0, imagesx($im)-$box[2]-10, imagesy($im)-10, $white, $font, $watermark);
		
		if($phrase->from){
			$box = imagettfbbox(20, 0, $font, "DE: ".strtoupper($phrase->from));
			
			imagettftext($im, 20, 0, 12, 32, $black, $font, "DE: ".strtoupper($phrase->from));
			imagettftext($im, 20, 0, 10, 30, $white, $font, "DE: ".strtoupper($phrase->from));
		}
		
		if($phrase->to){
			$box = imagettfbbox(20, 0, $font, "PARA: ".strtoupper($phrase->to));
		
			imagettftext($im, 20, 0, imagesx($im)-$box[2]-8, 32, $black, $font, "PARA: ".strtoupper($phrase->to));
			imagettftext($im, 20, 0, imagesx($im)-$box[2]-10, 30, $white, $font, "PARA: ".strtoupper($phrase->to));
		}
		
		imagepng($im,$tmp);
		imagedestroy($im);
		
		return $name;
	}
	
	public function view($id){
		$this->config->load('config'); 
		$base_url = $this->config->item('base_url');
			
		$image = $this->renderPhrase($id);
		
		echo '<img src="'.$base_url.'backgrounds/watermark/'.$image.'">';
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
		
		$this->load->model('Category');
		$this->load->model('Tag');
		
		$this->load->model('PhraseCategory');
		$this->load->model('PhraseTag');
		
		if($this->input->post()){
			$this->load->model('Phrase');
			
			$phrase = array('phrase' => $this->input->post("phrase"), 'from' => $this->input->post("from"), 'to' => $this->input->post("to"), 'background_id' => 1, 'font_id' => $this->input->post("font"));
			
			$categorias = $this->input->post("categorias");
			$etiquetas = $this->input->post("etiquetas"); 
			
			$id = $this->Phrase->insert($phrase);
			
			for ($i=0;$i<count($categorias);$i++){
				if($categorias[$i]){
					$tag = array('phrase_id' => $id, 'category_id' => $categorias[$i]);
				
					$this->PhraseCategory->insert($tag);	
				}   
			}
			
			for ($i=0;$i<count($etiquetas);$i++){
				if($etiquetas[$i]){
					$tag = array('phrase_id' => $id, 'tag_id' => $etiquetas[$i]);
				
					$this->PhraseTag->insert($tag);
				}    
			}
			
			$data["variable"] = $this->Phrase->fetch($id);
			
			$data["message"] = "<strong>¡Registro Exitoso!</strong> La Página ha sido registrada correctamente.";
			
			$this->load->view('admin/alerts/success',$data);
		}
		else{
			$data["variable"] = false;
		}
		
		$data["backgrounds"] = $this->Background->report("id > 0");
		$data["fonts"] = $this->Font->report("id > 0");
		$data["categories"] = $this->Category->report("id > 0");
		$data["tags"] = $this->Tag->report("id > 0");
		
		$this->load->view('admin/phrases/form',$data);
		
		$this->load->view('templates/admin_footer');
	}
	
	public function edit($id = false){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Phrase');
		$this->load->model('Background');
		$this->load->model('Font');
		
		$this->load->model('Category');
		$this->load->model('Tag');
		
		$this->load->model('PhraseCategory');
		$this->load->model('PhraseTag');
		
		if($this->input->post()){
			$phrase = $this->Phrase->fetch($this->input->post("id"));
			
			$phrase->phrase = $this->input->post("phrase");
			$phrase->from = $this->input->post("from");
			$phrase->to = $this->input->post("to");
			
			$phrase->font_id = $this->input->post("font");
			
			$this->Phrase->update($phrase);
			
			$categorias = $this->input->post("categorias");
			$etiquetas = $this->input->post("etiquetas"); 
			
			$id = $this->input->post("id");
			
			$tmp = $this->PhraseCategory->report("phrase_id = $id");
			
			if($tmp) foreach($tmp as $category){
				$this->PhraseCategory->delete($category);
			}
			
			$tmp = $this->PhraseTag->report("phrase_id = $id");
			
			if($tmp) foreach($tmp as $tag){
				$this->PhraseTag->delete($tag);
			}
			
			for ($i=0;$i<count($categorias);$i++){
				if($categorias[$i]){
					$tag = array('phrase_id' => $id, 'category_id' => $categorias[$i]);
					
					$this->PhraseCategory->insert($tag);
				}    
			}
			
			for ($i=0;$i<count($etiquetas);$i++){
				if($etiquetas[$i]){
					$tag = array('phrase_id' => $id, 'tag_id' => $etiquetas[$i]);
					
					$this->PhraseTag->insert($tag);
				}    
			}
			
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
		$data["categories"] = $this->Category->report("id > 0");
		$data["tags"] = $this->Tag->report("id > 0");
		
		$tmp = $this->PhraseCategory->report("phrase_id = $id");
		$data["categories_selected"] = array();
		
		if($tmp) foreach($tmp as $category){
			$data["categories_selected"][$category->id] = $category;
			//Consultar relaciobes 1:N con otras tablas
			$data["categories_selected"][$category->id]->phrase_id = $this->Phrase->fetch($category->phrase_id);
			$data["categories_selected"][$category->id]->category_id = $this->Category->fetch($category->category_id);
		}
		
		$tmp = $this->PhraseTag->report("phrase_id = $id");
		$data["tags_selected"] = array();
		
		if($tmp) foreach($tmp as $tag){
			$data["tags_selected"][$tag->id] = $tag;
			//Consultar relaciobes 1:N con otras tablas
			$data["tags_selected"][$tag->id]->phrase_id = $this->Phrase->fetch($tag->phrase_id);
			$data["tags_selected"][$tag->id]->tag_id = $this->Tag->fetch($tag->tag_id);
		}
		
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

	public function backgrounds($id){
		$this->load->model('Background');
		
		$backgrounds = $this->Background->report("id > 0","id DESC",30);
		
		$this->config->load('config'); 
		$base_url = $this->config->item('base_url');
		
		if($backgrounds) foreach($backgrounds as $background){
			$imagen = explode(".",$background->image);
			echo '<a href="'.$base_url.'index.php/phrases/seleccionarBackground/'.$id.'/'.$background->id.'"><img src="'.$base_url.'backgrounds/thumbnails/'.$imagen[0].'_thumb.'.$imagen[1].'" style="padding: 3px;" /></a>';
		}
	} 
	
	public function seleccionarBackground($id, $background_id){
		$this->load->view('templates/admin_header');
		
		$this->load->model('Phrase');
		$this->load->model('Background');
		$this->load->model('Font');
		
		$phrase = $this->Phrase->fetch($id);
			
		$phrase->background_id = $background_id;
		
		$this->Phrase->update($phrase);
		
		$phrases = $this->Phrase->report("id > 0");
		$data["phrases"] = array();
		
		if($phrases) foreach($phrases as $phrase){
			$data["phrases"][$phrase->id] = $phrase;
			
			//Consultar relaciones 1:N con otras tablas
			$data["phrases"][$phrase->id]->background_id = $this->Background->fetch($phrase->background_id);
			$data["phrases"][$phrase->id]->font_id = $this->Font->fetch($phrase->font_id);
		}
		
		$data["message"] = "<strong>¡Actualización Exitosa!</strong> El Fondo de la frase ha sido actualizado.";
		$this->load->view('admin/alerts/success',$data);
		
		$this->load->view('admin/phrases/report', $data);
		
		$this->load->view('templates/admin_footer');
	}
}
?>