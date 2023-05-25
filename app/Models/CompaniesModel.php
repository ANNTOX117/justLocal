<?php

namespace App\Models;
use CodeIgniter\Model;

class CompaniesModel extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $allowedFields = ["name","slug","title","review","type_company_id","city_id","user_id","description","long_description","profile_img_url","bg_img_url","website","phone","email","address","num_house","facebook","instagram","linkedin","block","active","deleted"];

    public function get_page_by_slug($slug)
    {
        // Query the database to retrieve the page information by slug
        $query = $this->getWhere(['slug' => $slug]);
        // Check if the query returned any result
        if ($query->resultID->num_rows > 0) {
            return $query->getRowArray(0);
        } else {
            return null;
        }
    }

    public function get_company_by_offer_slug($slug)
    {
        
        $query = $this->getWhere(['slug' => $slug]);
        // Check if the query returned any result
        if ($query->resultID->num_rows > 0) {
            return $query->getRowArray(0);
        } else {
            return null;
        }
    }

    public function get_info(){
        $where = array(
            'companies.id' => 1 
        );
        return $this->select(['companies.*', 'page_config.*'])
            ->join("page_config","page_config.company_id = companies.id")
            ->where($where)
            ->get()
            ->getResult();
    }

    public function get_all($id){
        $where = array(
            'companies.id' => $id 
        );
        return $this->select(['companies.*', 'companies.city_id'])
            ->where($where)
            ->get()
            ->getResult();
    }
    
    public function get_random_companies($limit = 5,$select="*")
    {
        return $this->select($select)
        ->orderBy('RAND()')
        ->limit($limit)
        ->get()
        ->getResult();
    }

    public function get_company_to_select()
    {
        $where = array(
            "block" => 0
        );
        $query = $this->select("id,name")->where($where)->get();
        return $query->getResult();
    }

    public function get_user_company($id){
        $where = array(
            'user_id' => $id
        );
        $query = $this->where($where)->get();
        return $query->getResult();
    }

    public function get_all_companies()
    {
        return $this->get()->getResult();
    }
    
    public function get_by_user($user_id)
    {
        $where = array(
            "user_id" => $user_id
        );
        $query = $this->where($where)->get();
        return $query->getResult();
    }

    public function company_owns_user($company_id,$user_id)
    {
        $where = array(
            "id" => $company_id,
            "user_id" => $user_id
        );
        $query = $this->getWhere($where);
        return $query->resultID->num_rows > 0;
    }

    public function get_all_companies_by_user($user_id)
    {
        $where = array(
            "user_id" => $user_id
        );
        $query = $this->getWhere($where);
        if ($query->resultID->num_rows > 0) {
            return $query->getResult();
        } else {
            return null;
        }
    }

    public function get_companies_paginate(){
        return $this->paginate(6);
    }

    public function searching_companies($type = null,$province = null,$city = null,$branche = null,$name_company = null)
    {
        $where = array(
            "companies.block" => 0,
            "companies.active" => 1,
            "companies.deleted" => 0,
        );
        if ($type !== null) $where["companies.type_company_id"] = $type;
        if ($province !== null) $where["cities.province_id"] = $province;
        if ($city !== null) $where["companies.city_id"] = $city;
        if ($name_company !== null) {
            $where["companies.name LIKE"] = "%$name_company%";
        }

        $this->select("companies.id id, companies.name company_name,companies.slug slug, companies.type_company_id type_company ,companies.title title,companies.review review,COUNT(offers.id) total_offers ,cities.name city_name,provinces.name province_name");
        $this->join("offers","companies.id = offers.company_id AND offers.block = 0 AND offers.active = 1 AND offers.deleted = 0","left");
        $this->join("cities","companies.city_id = cities.id");
        $this->join("provinces","cities.province_id = provinces.id");
        if ($branche !== null) {
            $where["branches_by_company.branche_id"] = $branche;
            $this->join("branches_by_company","companies.id = branches_by_company.company_id");
        }
        $this->where($where);
        $this->groupBy('companies.id');
        $this->orderBy('total_offers', 'DESC');
        return $this->paginate(12);
    }

    public function get_companies_by_province_cities($province_id,$city_id)
    {
        $where = array(
            "companies.block" => 0,
            "companies.active" => 1,
            "companies.deleted" => 0,
            "provinces.id" => $province_id,
            "cities.id" => $city_id
        );

        $this->select("companies.id id, companies.name company_name,companies.slug slug, companies.title title,companies.review review,COUNT(offers.id) total_offers,cities.name city_name,provinces.name province_name");
        $this->join("offers","companies.id = offers.company_id","left");
        $this->join("cities","companies.city_id = cities.id");
        $this->join("provinces","cities.province_id = provinces.id");
        $this->where($where);
        $this->groupBy("companies.id");
        $this->orderBy("total_offers DESC");
        return $this->paginate(12);
    }
}