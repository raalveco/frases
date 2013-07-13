<?php
	class ActiveRecord extends CI_Model{
		function report($where = "id > 0", $order = "id ASC", $limit = 30, $offset = 0)
	    {
	    	$class = get_called_class();
			$class = strtolower($class);
			
			$this->db->select('*');
			$this->db->from($class);
	    	$this->db->where($where);
			$this->db->order_by($order); 
			$this->db->limit($limit, $offset);
			
	    	$query = $this->db->get();
	        return $query->result();
	    }
	}
?>