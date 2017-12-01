<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model {

    // Save data
    public function saveData($tbl_name, $data)
    {
        $query = $this->db->insert($tbl_name, $data);

		if($query)
		{
			return true;
		}
		else 
		{ 
			return false; 
		}	
    }

    // Save data batch
    public function saveDataBatch($tbl_name, $data)
    {
        $query = $this->db->insert_batch($tbl_name, $data);
        
		if($query)
		{
			return true;
		}
		else 
		{ 
			return false; 
		}	
    }

    // Update data
    public function updateData($tblname, $where, $condition, $data)
	{
		$this->db->where($where, $condition);
		$query = $this->db->update($tblname, $data);
		return $query;
	}

    // Check existing field on save
    public function checkAlreadyExist($tableName, $checkField, $insertValue)
    {
        $this->db->where($checkField, $insertValue);
        $this->db->where('display','Y');    
        $q = $this->db->get($tableName);

        if($q->num_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    } 

    // CHeck existing field on update
    public function checkAlreadyExistOnUpdate($tableName, $checkField, $insertValue, $where, $id)
    {
        $this->db->where($checkField, $insertValue);
        $this->db->where('display','Y');   
        $this->db->where($where.'!='.$id);
        $qry=$this->db->get($tableName);
        
        if($qry->num_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }
        
    } 

    // Get data from table
	public function getDataFromTableASC($table_name, $field_name)
    {
        $this->db->from($table_name)->where('display','Y')->order_by($field_name, 'ASC');
 
        $query = $this->db->get();
 
        return $query->result();
    }

    // Get data from table
	public function getDataFromTableDESC($table_name, $field_name)
    {
        $this->db->from($table_name)->where('display','Y')->order_by($field_name, 'DESC');
 
        $query = $this->db->get();
 
        return $query->result();
    }

    // Get single data from table
    public function getSingleRecord($tableName, $uniqueField, $id)
    {
        $this->db->where($uniqueField, $id);
        $this->db->where('display','Y');
        $query = $this->db->get($tableName);
        return $query->row();
    }

}

/* End of file Master_model.php */
/* Location: ./application/models/Master_model.php */