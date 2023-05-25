<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["name","password","blocked","active","verified","deleted","approved","email"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    public function find_user_login($email,$password)
    {
        $where = array(
            "email" => $email
        );
        $query = $this->getWhere($where);
        if ($query->resultID->num_rows > 0) {
            $data =  $query->getRow();
            if(password_verify($password,$data->password)){
                if ($data->blocked == "1") return lang("Errors.blocked_user");
                if ($data->active == "0") return lang("Errors.actived_user");
                if ($data->verified == "0") return lang("Errors.verified_user");
                if ($data->deleted == "1") return lang("Errors.deleted_user");
                if ($data->approved == "0") return lang("Errors.approved_user");
                return $data;
            }else{
                return "The password doesnt match with the email.";
            }
        } else {
            return "No user found.";
        }
    }

    public function get_all_member_users()
    {
        $where = array(
            "type_user_id" => 2
        );
        $this->select('users.*,companies.name as company_name')
            ->join("companies","users.id = companies.user_id")
            ->where($where)
            ->groupBy('users.id');
        $query = $this->get();
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }

    public function get_user_by_id($user_id)
    {
        $where = array(
            "type_user_id" => 2,
            "users.id" => $user_id
        );
        $this->select('users.*,companies.id as company_id,companies.name as company_name,companies.block as company_block,companies.active as company_active,companies.deleted as company_deleted')
            ->join("companies","users.id = companies.user_id")
            ->where($where)
            ->groupBy('users.id')
            ->limit(1);
        $query = $this->get();
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        } else {
            return null;
        }
    }
    
    public function get_info($id){
        $where = array(
            'id' => $id
        );
        $query = $this->where($where)->get();
        return $query->getResult(); 
    }

    public function delete_user($user_id)
    {
        $where = array(
            'id'=>$user_id,
            "type_user_id" => 2
        );
        //return $this->where($where)->delete();
    }
}
