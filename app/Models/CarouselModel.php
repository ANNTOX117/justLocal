<?php

namespace App\Models;

use CodeIgniter\Model;

class CarouselModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'carousels';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["url_image","url_redirect","order_image","page","block"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function get_last_order_carousel_by_page($page)
    {
        $where = array("page" => $page);
        $this->select("MAX(order_image) as order_max")->where($where)->limit(1);
        $query = $this->get();
        return $query->getRow();
    }

    public function insert_carousel_by_page($page,$data)
    {
        $order = $this->get_last_order_carousel_by_page($page);
        $data["order_image"] = isset($order->order_max)?(int)$order->order_max+1:1;
        return $this->insert($data);
    }

    public function get_all_carousel_by_page($page)
    {
        $where = array(
            "page" => $page,
            "block" => 0
        );
        $query = $this->select("id,url_image,url_redirect,order_image")->where($where)->get();
        return $query->getResult();
    }
}
