<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\BrancheModel;
use App\Models\CatTypeCompanyModel;
use App\Models\ProvincesModel;
use App\Models\UsersModel;
use Config\Services;

class LoginController extends BaseController
{
    protected $lang;
    public function __construct() {
        $this->lang = Services::request()->getLocale();
    }
    public function index()
    {
        $provinces = new ProvincesModel();
        $type_companies = new CatTypeCompanyModel();
        $branches = new BrancheModel();
        $data = array(
            "provinces" => $provinces->get_provinces_by_country(1),
            "type_companies" => $type_companies->get_all_type_companies(),
            "branches"  => $branches->get_all_branches()
        );
        echo $this->generate_view($data,"pages/general/login_view");
    }

    public function logUser(){
        helper("strings");
        $email = sanitize_string($_POST["email"]);
        $password = $_POST["password"];
        $user = new UsersModel();
        $login_user = $user->find_user_login($email,$password);
        if(gettype($login_user) !== "string"){
            // $session = session();
            // $session->start();
            session()->set('user_id', $login_user->id);
            session()->set('name', $login_user->name);
            session()->set('type_user', $login_user->type_user_id);
            session()->set('email', $login_user->email);
            session()->set('logged', true);
            // $session->set('user_id', $login_user->id);
            // $session->set('name', $login_user->name);
            // $session->set('type_user', $login_user->type_user_id);
            // $session->set('email', $login_user->email);
            // $session->set('logged', true);
        } else {
            session()->setFlashdata('err_message', 'The email or password are incorrect');
            return redirect()->to('login');
            // return $this->response->setStatusCode(404)->setJSON(['error' => "error in login","msg" => $login_user]);
        }
        if ($login_user->type_user_id === NULL) 
            return $this->response->redirect('login');
        return $login_user->type_user_id == 2 ? $this->response->redirect('admin/companies') : $this->response->redirect('admin/home');
    }

    public function logged()
    {
        if (session()->get("type_user") === NULL) return $this->response->redirect('login');
        return session()->get("type_user") == 2?$this->response->redirect('/company'):$this->response->redirect('admin/home');
    }

    public function logout()
    {
        $session = \Config\Services::session();
        // Destroy the session
        $session->destroy();
        // Redirect the user to the login page
        return redirect()->to('/login');
    }

    private function generate_view($data,$url_main)
    {
        $structure = array(
            'header' => view('templates/general/menu_view', $data),
            "js" => array(
                '<script src="'.base_url("assets/ownsite/js/general/login.js").'"></script>'
            ),
            "lang" => $this->lang,
            'main' => view($url_main, $data),
            'footer' => view('templates/general/footer_view', $data)
        );
        return view('layouts/layout_general_view', $structure);
    }
}
