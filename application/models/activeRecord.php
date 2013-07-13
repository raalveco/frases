<?php
	class ActiveRecord extends CI_Model{
		function last_entries($n = 10)
	    {
	    	$class = get_called_class();
			$class = strtolower($class);
			
	    	$query = $this->db->get($class, $n);
	        return $query->result();
	    }
	}
?>