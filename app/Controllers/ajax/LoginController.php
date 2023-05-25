<?php
namespace App\Controllers\Ajax;

use App\Controllers\BaseController;
use App\Models\BranchesCompanyModel;
use App\Models\CompaniesModel;
use App\Models\UsersModel;

class LoginController extends BaseController
{
    public function validate_user()
    {
        helper("strings");
        $email = sanitize_string($_POST["email"]);
        $password = $_POST["password"];
        $user = new UsersModel();
        $login_user = $user->find_user_login($email,$password);
        if(gettype($login_user) !== "string"){
            $session = session();
            $session->start();
            $session->set('user_id', $login_user->id);
            $session->set('name', $login_user->name);
            $session->set('type_user', $login_user->type_user_id);
            $session->set('email', $login_user->email);
            $session->set('logged', true);
        }else{
            return $this->response->setStatusCode(404)->setJSON(['error' => "error in login","msg" => $login_user]);
        }
    }

    public function insert_user()
    {
        helper("strings");
        $data_error = [];
        $convert_to_string = (string)$this->request->getPost("all_branches"); 
        if ($convert_to_string === ""){
            array_push($data_error,array("all_branches"=> lang("Errors.required_branche")));
        }else{
            $data_branch = explode(",", $convert_to_string);
        }
        
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name_company' => [
                'rules' => 'required|min_length[3]|max_length[255]|is_unique[companies.name]',
                'errors' => [
                    'required' => lang("Errors.required_name_company"),
                    'is_unique' => lang("Errors.unique_name_company"),
                    "min_length" => lang("Errors.min_len_name_company"),
                    "max_length" => lang("Errors.max_len_name_company")
                ],
            ],
            'title_company' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => lang("Errors.required_title_company"),
                    "min_length" => lang("Errors.min_len_title_company"),
                    "max_length" => lang("Errors.max_len_title_company")
                ],
            ],
            'name_contac_person' => [
                'rules' => 'required|min_length[3]|max_length[255]',
                'errors' => [
                    'required' => lang("Errors.required_name_contac_person"),
                    "min_length" => lang("Errors.min_len_name_contact_company"),
                    "max_length" => lang("Errors.max_len_name_contact_company")
                ],
            ],
            'website' => [
                'label' => 'Website',
                'rules' => 'required|valid_url|min_length[3]|max_length[255]|is_unique[companies.website]',
                'errors' => [
                    'required' => lang("Errors.required_website"),
                    'valid_url' => lang("Errors.valid_website"),
                    'is_unique' => lang("Errors.unique_website"),
                    "min_length" => lang("Errors.min_len_website"),
                    "max_length" => lang("Errors.max_len_website")
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => lang("Errors.required_email"),
                    'valid_email' => lang("Errors.valid_email"),
                    'is_unique' => lang("Errors.unique_email"),
                ],
            ],
            'phone_number' => [
                'rules'=> 'required|min_length[8]|max_length[10]',
                'errors' => [
                    'required' => lang("Errors.required_phone"),
                    "min_length" => lang("Errors.min_len_phone"),
                    "max_length" => lang("Errors.max_len_phone")
                ],
            ],
            'city' => [
                'rules' => 'required',
                'errors' => [
                    'required' => lang("Errors.required_city"),
                ],
            ],
            'type_company' => 'required',
            'descriptionShortCompany' => 
            [
                "rules" =>'required|min_length[10]',
                'errors' => [
                    'required' => lang("Errors.required_short_description"),
                    "min_length" => lang("Errors.min_len_short_description"),
                ],
            ]
            
        ]);
        if (!$validation->run($this->request->getPost())) array_push($data_error,array($validation->getErrors()));
        $file = $this->request->getFile('imageCompany');
        if (!$file->isValid()) {
            array_push($data_error,array("imageCompany"=> lang("Errors.required_image_logo")));
        }else{
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $_FILES["imageCompany"]["tmp_name"]);
            if (strpos($mime_type, "image/") !== 0) {
                array_push($data_error,array("imageCompany"=>lang("Errors.required_image_bg")));
            }else{
                if ($_FILES["imageCompany"]["size"] > 2 * 1024 * 1024) {
                    array_push($data_error,array("imageCompany"=>lang("Errors.valid_image")));
                }
            }
        }
        $fileBg = $this->request->getFile('imageBg');
        if (!$fileBg->isValid()) {
            array_push($data_error,array("imageBg"=>lang("Errors.required_image_bg")));
        }else{
            $finfoBg = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type_bg = finfo_file($finfoBg, $_FILES["imageBg"]["tmp_name"]);
            if (strpos($mime_type_bg, "image/") !== 0) {
                array_push($data_error,array("imageBg"=>lang("Errors.required_image_bg")));
            }else{
                if ($_FILES["imageBg"]["size"] > 2 * 1024 * 1024) {
                    array_push($data_error,array("imageBg"=>lang("Errors.valid_image")));
                }
            }
        }
        $errors_merged = array();
        foreach ($data_error as $error) {
            foreach ($error as $key => $message) {
                if (is_array($message)) {
                    foreach ($message as $subkey => $submessage) {
                        $errors_merged[$subkey] = $submessage;
                    }
                } else {
                    $errors_merged[$key] = $message;
                }
            }
        }
        if (count($errors_merged) >0) return $this->response->setStatusCode(404)->setJSON(['error' => $errors_merged]);
        $users = new UsersModel();
        try {
            $data = array(
                "name" => sanitize_string($this->request->getPost("name_contac_person"),"lower"),
                "type_user_id" => 2,
                "blocked" => 0,
                "active" => 0,
                "verified" => 0 ,
                "deleted" => 0,
                "approved" => 0,
                "email" => sanitize_string($this->request->getPost("email"),"lower")
            );
            $image_brand = $this->request->getFile('imageCompany');
            $image_brand_name = $image_brand->getRandomName();
            $image_brand_bg = $this->request->getFile('imageBg');
            $image_brand_bg_name = "bg_".$image_brand_bg->getRandomName();
            $id = $users->insert($data);
            $companies = new CompaniesModel();
            $data_company = array(
                "name" => sanitize_string($this->request->getPost("name_company"),"lower"),
                "slug" => create_slug($this->request->getPost("name_company")),
                "title" => sanitize_string($this->request->getPost("title_company"),"none"),
                "type_company_id" => sanitize_string($this->request->getPost("type_company"),"lower"),
                "city_id" => sanitize_string($this->request->getPost("city"),"lower"),
                "user_id" => $id,
                "description" => sanitize_string($this->request->getPost("descriptionShortCompany"),"none"),
                "long_description" => sanitize_string($this->request->getPost("descriptionLargeCompany"),"none"),
                "profile_img_url" => $image_brand_name,
                "bg_img_url" => $image_brand_bg_name,
                "website" => sanitize_string($this->request->getPost("website"),"lower"),
                "phone" => sanitize_string($this->request->getPost("phone_number"),"lower"),
                "email" => sanitize_string($this->request->getPost("email"),"lower"),
                "address" => sanitize_string($this->request->getPost("address"),"lower"),
                "num_house" => sanitize_string($this->request->getPost("interior_number"),"lower"),
            ); 
            $id_company = $companies->insert($data_company);
            $directory_company = 'uploads/company/'.$id_company.'/profile/';
            if (!is_dir($directory_company)) {
                mkdir($directory_company, 0777, true);
            }
            $image_brand_insert = \Config\Services::image()
                ->withFile($image_brand)
                //->resize(100, 100, true, 'height')
                ->save($directory_company. $image_brand_name);
            $image_brand_insert = \Config\Services::image()
            ->withFile($image_brand)
            ->resize(400, 400, true)
            ->save($directory_company."logo_".$image_brand_name);
            $image_brand_insert_bg = \Config\Services::image()
            ->withFile($image_brand_bg)
            ->save($directory_company.$image_brand_bg_name);
            $image_brand_bg_insert_bg = \Config\Services::image()
            ->withFile($image_brand_bg)
            ->resize(800, 800, true)
            ->save($directory_company."resize_".$image_brand_bg_name);


            $branch_company = new BranchesCompanyModel();
            foreach ($data_branch as $branch) {
                $branch_company->insert([
                    "company_id" => $id_company,
                    "branche_id" => $branch
                ]);   
            }
            return  $this->response->setStatusCode(200)->setJSON(['success' => "Company inserted, just wait for the access by the admin to log in"]);
        } catch (\Throwable $th) {
            return  $this->response->setStatusCode(404)->setJSON(['error' => $th]);
        }
    }
}
