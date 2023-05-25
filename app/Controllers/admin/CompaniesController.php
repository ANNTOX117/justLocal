<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriesModel;
use App\Models\CatTypeCompanyModel;
use App\Models\CitiesModel;
use App\Models\CompaniesModel;
use App\Models\CountriesModel;
use App\Models\IndustryModel;

class CompaniesController extends BaseController
{
    public function index()
    {
        $categories = new CategoriesModel();
        $all_catefories = $categories->findAll();
        $industries = new IndustryModel();
        $type_company = new CatTypeCompanyModel();
        $companies = new CompaniesModel();
        $contries = new CountriesModel();
        $rol = session()->get('type_user');
        $data = array(
            "categories" => $all_catefories,
            "industries" => $industries->get_all_industries(),
            "type_companies" => $type_company->get_all_type_companies(),
            "countries" => $contries->get_countries_available(),
            "companies" => $rol == 3 ? $companies->get_companies_paginate() : json_decode(json_encode($companies->get_user_company(session()->get('user_id'))), true),
            // "companies" => $companies->get_companies_paginate(),
            'pager'             => $companies->pager,
        );
        return $this->generate_view($data,"pages/admin/companies_view");
    }

    private function generate_view($data,$url_main)
    {
        $structure = array(
            "js"       => array(
                '<script src="'.base_url('assets/ownsite/js/admin/companies.js').'"></script>'
            ),
            'header'    => view('templates/admin/menu_view', $data),
            'main'      => view($url_main, $data),
            'footer'    => view('templates/admin/footer_view', $data)
        );
        return view('layouts/layout_general_view', $structure);
    }

    public function getCompany($id_company){
        $company = new CompaniesModel();
        $company = $company->get_all($id_company);
        $company = isset($company[0]) ? $company[0] : $company;
        $city = new CitiesModel();
        $info = $city->get_info($company->city_id);
        $data = [
            'company' => $company,
            'info' => $info,
        ];
        echo json_encode($data);
    }

    public function add()
    {
        helper('strings');
        // $rules = [
        //     'companyImage' => [
        //         'rules' => 'uploaded[companyImage]|max_size[companyImage,2048]|mime_in[companyImage,image/jpg,image/jpeg,image/png,image/gif]',
        //         'label' => 'Image',
        //         'errors' => [
        //             'uploaded' => 'Please select an image branch to upload for the branch',
        //             'max_size' => 'The uploaded image is too large. Please select an image that is less than 2MB in size',
        //             'mime_in' => 'The uploaded file is not an image. Please select a valid JPG, JPEG, or PNG image file'
        //         ]
        //         ],
        //     'companyImageBg' => [
        //         'rules' => 'uploaded[companyImageBg]|max_size[companyImageBg,2048]|mime_in[companyImageBg,image/jpg,image/jpeg,image/png,image/gif]',
        //         'label' => 'Image background',
        //         'errors' => [
        //             'uploaded' => 'Please select an image to upload for the background',
        //             'max_size' => 'The uploaded image is too large. Please select an image that is less than 2MB in size',
        //             'mime_in' => 'The uploaded file is not an image. Please select a valid JPG, JPEG, or PNG image file'
        //         ]
        //     ]
        // ];
        // if (!$this->validate($rules)) {
        //     $errors = $this->validator->getErrors();
        //     return $this->response->setStatusCode(500)->setJSON(['error' => $errors,"msg"=>"the images can't be bigger that 2MB"]);
        // }
        try {
            $model = new CompaniesModel();
            $id_company = $this->request->getVar('id_company');
            // var_dump($id_company); die();
            $image_brand = $this->request->getFile('companyImage');
            $image_brand_name = $image_brand != null ? $image_brand->getRandomName() : null;
            $image_bg =$this->request->getFile('companyImageBg');
            $image_bg_name = $image_bg != null ? $image_bg->getRandomName() : null;
            $data_insert = array(
                "name" => $this->request->getVar('companyName'),
                "slug" => create_slug($this->request->getVar('companyName')),
                "type_company_id" => $this->request->getVar('companyType'),
                "industry_id" => $this->request->getVar('companyIndustry'),
                "category_id" => $this->request->getVar('companyCategory'),
                "description" => $this->request->getVar('companyDescription'),
                "profile_img_url" => $image_brand_name,
                "bg_img_url" => $image_bg_name,
                "website" => $this->request->getVar('companyWebsite'),
                "phone" => $this->request->getVar('companyPhone'),
                "email" => $this->request->getVar('companyEmail'),
                "address" => $this->request->getVar('companyAddress'),
                "facebook" => $this->request->getVar('companyFacebook'),
                "instagram" => $this->request->getVar('companyInstagram'),
                "city_id" => $this->request->getVar('companyCities'),
                "blocked" => $this->request->getVar('blockCompany'),
            );

            $model->update($id_company,$data_insert);
                // $directory_company = 'uploads/company/'.$model->insertID();
                $directory_company = 'uploads/company/'.$id_company.'/';

                // if (!$image_brand->isValid()) {
                //     return $this->response->setStatusCode(500)->setJSON(['error' => 'An error occurred while uploading the image']);
                // }
                // if (!$image_bg->isValid()) {
                //     return $this->response->setStatusCode(500)->setJSON(['error' => 'An error occurred while uploading the image']);
                // }
                if (!is_dir($directory_company)) {
                    mkdir($directory_company, 0777, true);
                }
                if ($image_brand != null && $image_brand->isValid()) {
                    $image_brand_insert = \Config\Services::image()
                    ->withFile($image_brand)
                    ->resize(100, 100, true, 'height')
                    ->save($directory_company. $image_brand_name);
                }
                if ($image_bg != null && $image_bg->isValid()) {
                    $image_bg_insert = \Config\Services::image()
                    ->withFile($image_bg)
                    ->resize(300, 300, true, 'height')
                    ->save($directory_company. $image_bg_name);
                    // return $this->response->setStatusCode(500)->setJSON(['error' => 'An error occurred while uploading the image']);
                }
                // $image_brand_insert = \Config\Services::image()
                //     ->withFile($image_brand)
                //     ->resize(100, 100, true, 'height')
                //     ->save($directory_company. $image_brand_name);
                // $image_bg_insert = \Config\Services::image()
                // ->withFile($image_bg)
                // ->resize(300, 300, true, 'height')
                // ->save($directory_company. $image_bg_name);
                //$x_file->move($directory_company);
                // if (!$x_file->move($directory_company,$newName)) {
                //     return $this->response->setStatusCode(500)->setJSON(['error' => $x_file->getError()]);
                // }
                return $this->response->setStatusCode(200)->setJSON(['success' => "The company was inserted successfully","id"=>$model->insertID()]);
        } catch (\Throwable $th) {
            return $this->response->setStatusCode(500)->setJSON(['error' => "It's no possible insert the information","e"=>$th, "erro"=>$th->getMessage(), "line"=>$th->getLine()]);
        }
    }
}
