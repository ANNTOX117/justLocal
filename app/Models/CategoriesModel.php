<?php

namespace App\Models;
use CodeIgniter\Model;

class CategoriesModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'block'];

    public function update_category($id, $data)
    {
        $this->db->where('id', $id)->update($data);
    }

    public function get_categories()
    {
        $where = array(
            "block" => 0
        );
        //$query = $this->select("id,name")->where($where)->orderBy("order_image")->get();
        $query = $this->select("id,name")->where($where)->get();
        return $query->getResult();
    }
}
