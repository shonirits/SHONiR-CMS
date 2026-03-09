<?php namespace App\Models;
use CodeIgniter\Model;
use App\Models\BaseModel;

class ToolsModel extends BaseModel
{
    
    
      function insert_captcha($var_data){
    
        $builder = $this->db->table('captcha');
    
        $query = $builder->insert($var_data);
    
        return $query;
    
      }
    
    
      function get_captcha($where){
    
        $builder = $this->db->table('captcha');
    
      $query = $builder->where($where)
                         ->get();    
     $db_data = $query->getRowArray();
    
       return $db_data;
    
     }
    

    public function delete_captcha($where){

      $builder = $this->db->table('captcha');
      $builder->where($where);
      $query = $builder->delete();

      return $query;
    
      }


}