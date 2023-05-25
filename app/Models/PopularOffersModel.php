<?php

namespace App\Models;

use CodeIgniter\Model;

class PopularOffersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'popular_offers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["offer_id"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';


    public function get_all_offers()
    {
        $where = array(
            "offers.block" => 0,
            "companies.block" => 0
        );
        $this->select("popular_offers.id,popular_offers.offer_id,companies.name as name,offers.title,offers.slug,companies.description,offers.discount,cities.name as city_name,provinces.name as province_name");
        $this->join("offers","offers.id = popular_offers.offer_id","inner");
        $this->join("companies","offers.company_id = companies.id","inner");
        $this->join("cities","offers.city_id = cities.id","inner");
        $this->join("provinces","cities.province_id = provinces.id","inner");
        $this->where($where);
        $query = $this->get();
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }

    public function deleteWhere($id){
        $this->where('popular_offers.offer_id', $id);
        $this->delete('popular_offers'); 
        return;

        $where = array(
            "popular_offers.offer_id" => $id
        );
        $this->where($where)->deleteBatch();
        return;
    }

    public function get_popular_offer_data($id)
    {
        $where = array(
            "popular_offers.id" => $id
        );
        $this->select("popular_offers.id,offers.title,companies.name");
        $this->join("offers","popular_offers.offer_id = offers.id","inner");
        $this->join("companies","offers.company_id = companies.id","inner");
        $this->where($where);
        $query = $this->get();
        if ($query->resultID->num_rows > 0) {
            return $query->getRow();
        } else {
            return null;
        }
    }

}
