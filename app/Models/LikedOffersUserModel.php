<?php

namespace App\Models;

use CodeIgniter\Model;

class LikedOffersUserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'liked_offers_by_user';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["offer_id","ip_user","type"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function check_if_ip_and_offer_exist_and_add_or_delete($where)
    {
        $this->where($where);
        $query = $this->get();
        if ($query->resultID->num_rows > 0) {
            $this->where($where)->delete();
            return $this->affectedRows() > 0;
        } else {
            return $this->insert($where);
        }
    }

    public function get_all_offers_user($ip,$type)
    {
        $where = array(
            "ip_user" => $ip,
            "type" => $type,
        );
        $this->select("offer_id");
        $this->where($where);
        $query = $this->get();
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }

    public function get_all_data_offer_companies_liked_user($ip,$type)
    {
        $where = array(
            "companies.block" => 0,
            "companies.active" => 1,
            "companies.deleted" => 0,
            "liked_offers_by_user.ip_user" => $ip
        );
        if ($type === "company") {  
            $this->select("companies.*");
            $this->join("companies","liked_offers_by_user.offer_id  = companies.id AND liked_offers_by_user.type = 'company'");
            
        }else{
            $where["offers.block"] = 0;
            $where["offers.active"] = 1;
            $where["offers.deleted"] = 0;
            $this->select("offers.*");
            $this->join("offers","liked_offers_by_user.offer_id = offers.id AND liked_offers_by_user.type = 'offer'");
            $this->join("companies","offers.company_id = companies.id");
        }
        $this->where($where);
        $query = $this->get();
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }
}
