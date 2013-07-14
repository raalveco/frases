<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index(){
		$this->load->model('User');
		
		$data["users"] = $this->User->report("id > 0");

		$this->load->view('templates/admin_header');
		$this->load->view('admin/users/report',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function posts($user_id){
		$this->load->model('Post');
		$this->load->model('User');
		$this->load->model('Phrase');
		
		$posts = $this->Post->report("user_id = $user_id");
		$data["posts"] = array();
		
		if($posts) foreach($posts as $post){
			$data["posts"][$post->id] = $post;
			
			$data["posts"][$post->id]->user_id = $this->User->fetch($post->user_id);
			$data["posts"][$post->id]->phrase_id = $this->Phrase->fetch($post->phrase_id);			
		}

		$this->load->view('templates/admin_header');
		$this->load->view('admin/users/posts',$data);
		$this->load->view('templates/admin_footer');
	}
	
	public function phrases($user_id){
		$this->load->model('UserPhrase');
		$this->load->model('User');
		$this->load->model('Phrase');
		
		$phrases = $this->UserPhrase->report("user_id = $user_id");
		$data["phrases"] = array();
		
		if($phrases) foreach($phrases as $phrase){
			$data["phrases"][$phrase->id] = $phrase;
			
			$data["phrases"][$phrase->id]->user_id = $this->User->fetch($phrase->user_id);
			$data["phrases"][$phrase->id]->phrase_id = $this->Phrase->fetch($phrase->phrase_id);			
		}

		$this->load->view('templates/admin_header');
		$this->load->view('admin/users/phrases',$data);
		$this->load->view('templates/admin_footer');
	}
}
?>