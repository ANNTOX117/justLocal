<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;

class CategoriesController extends BaseController
{
    public function index()
    {
        $categoriesModel = new CategoriesModel();
        $data = [
            "all_categories" => $categoriesModel->findAll()
        ];
        return $this->generate_view($data,"pages/admin/categories_view");
    }

    public function add()
    {
        $model = new CategoriesModel();
        $data = [
            'name' => $this->request->getVar('category'),
            'block' => !$this->request->getVar('blockCategory') ? true : false
        ];
        if ($this->request->getVar('id_category')!== null) {
            $category_exist = $model->find($this->request->getVar('id_category'));
            $model->update_category($this->request->getVar('id_category'),$data);
            return $this->response->setStatusCode(200)->setJSON(['success' => "The category was updated successfully","no_insert"=>true]);
        }else{
            try {
                $model->insert($data);
                //return 'Category added successfully!';
                return $this->response->setStatusCode(200)->setJSON(['success' => "The category was inserted successfully","id"=>$model->insertID()]);
            } catch (\Throwable $th) {
                return $this->response->setStatusCode(500)->setJSON(['error' => "It's no possible insert the information"]);
            }
        }
    }

    public function getCategory($id_category)
    {
        $categories = new CategoriesModel();
        $category = $categories->find($id_category);
        if ($category !== null) {
            return $this->response->setJSON($category);
        }else{
            $response = [
                'status' => 500,
                'msg' => "reload page"
                ];
            return $this->response->setJSON($response);
        }
    }

    private function generate_view($data,$url_main)
    {
        $structure = array(
            "js"       => array(
                '<script src="'.base_url('assets/ownsite/js/admin/categories.js').'"></script>'
            ),
            'header'    => view('templates/admin/menu_view', $data),
            'main'      => view($url_main, $data),
            'footer'    => view('templates/admin/footer_view', $data)
        );
        return view('layouts/layout_general_view', $structure);
    }
}
