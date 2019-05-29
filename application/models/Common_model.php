<?php
class Common_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function selectData($table='', $field='*', $where='', $order_by='', $order_type='',$distinct='',$return='') {
		$this->db->select($field);
		$this->db->from($table);
		if($where != '') {
			$this->db->where($where); 
		}
		if($order_by != '' && $order_type != '') {
			$this->db->order_by($order_by, $order_type);
		}
		if($distinct != '') {
			$this->db->distinct();
		}
		$query = $this->db->get();
		if($return == 'array') {
			return $query->result_array();
		} else {
			return $query->result();
		}
	}

	public function insertData($table='', $data='') {
		$query = $this->db->insert($table,$data);
		return $query;
	}

	public function updateData($table,$data,$where) {
		$this->db->where($where);
		if($this->db->update($table, $data)) {
			return 1;
		} else {
			return 0;
		}
	}

	public function deleteData($table,$where) {
		$this->db->where($where);
		if($this->db->delete($table)) {
			return 1;
		} else {
			return 0;
		}	
	}

	public function fetchUserFilter($search_value,$sort_field,$order_by) {
		$this->db->select('*');
		$this->db->from('user');
		if(!empty($search_value)) {
			$this->db->like('first_name', $search_value);
			$this->db->or_like('last_name', $search_value);
			$this->db->or_like('email', $search_value);
			$this->db->or_like('mobile', $search_value);
			$this->db->or_like('state', $search_value);
			$this->db->or_like('city', $search_value);
		}
		$this->db->order_by($sort_field, $order_by);
		$query = $this->db->get();
		return $query->result();		
	}

}