<?php
	class ActiveRecord extends CI_Model{
		function report($where = "id > 0", $order = "id ASC", $limit = 30, $offset = 0)
	    {
	    	$table = get_called_class();
			$table = strtolower($table);
			
			$this->db->select('*');
			$this->db->from($table);
	    	$this->db->where($where);
			$this->db->order_by($order); 
			$this->db->limit($limit, $offset);
			
	    	$query = $this->db->get();
	        return $query->result();
	    }
		
		function find($where = "id > 0", $order = "id ASC", $limit = 30, $offset = 0)
	    {
	    	$table = get_called_class();
			$table = strtolower($table);
			
			$this->db->select('*');
			$this->db->from($table);
	    	$this->db->where($where);
			$this->db->order_by($order); 
			$this->db->limit($limit, $offset);
			
	    	$query = $this->db->get();
	        return $query->result("array");
	    }
		
		function fetch($id){
			$table = get_called_class();
			$table = strtolower($table);
			
			$this->db->select('*');
			$this->db->from($table);
	    	$this->db->where("id = $id");
			
	    	$query = $this->db->get();
	        return $query->row();
		}
		
		function find_first($where = "id > 0", $order = "id ASC", $offset = 0){
			$table = get_called_class();
			$table = strtolower($table);
			
			$this->db->select('*');
			$this->db->from($table);
	    	$this->db->where($where);
			$this->db->order_by($order); 
			$this->db->limit(1,$offset);
			
	    	$query = $this->db->get();
	        return $query->row();
		}
		
		function insert($fields){
			$table = get_called_class();
			$table = strtolower($table);
			
			$this->db->insert($table, $fields);
			return $this->db->insert_id();
		}
		
		function update($object){
			$table = get_called_class();
			$table = strtolower($table);
			
			$this->db->where("id = ".$object -> id);
			$this->db->update($table, $object); 
		}
		
		function delete($object){
			$table = get_called_class();
			$table = strtolower($table);
			
			if(!is_numeric($object)){
				$this->db->where('id = '.$object->id);
			}
			else{
				$this->db->where("id = $object");
			}
			
			$this->db->delete($table);
		}
		
		function count($where = "id > 0"){
			$table = get_called_class();
			$table = strtolower($table);
			
			$this->db->where($where);
			$this->db->from($table);
			return $this->db->count_all_results(); 
		}
		
		function exists($where = "id > 0"){
			$table = get_called_class();
			$table = strtolower($table);
			
			$this->db->where($where);
			$this->db->from($table);
			if($this->db->count_all_results() > 0){
				return true;
			} 
			
			return false;
		}
	}
?>