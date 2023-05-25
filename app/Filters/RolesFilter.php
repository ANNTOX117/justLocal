<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RolesFilter implements FilterInterface
{
    /**
     * @param array|null $arguments
     *
     * @return RedirectResponse|void
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // var_dump($arguments, session());

        if(!session()->has('logged')) {
            session()->setFlashdata('err_message', 'You need to login');
            return redirect()->to('login')->with('fail', "You need to login");
        }

        foreach($arguments as $rol){
            if($rol == 'admin' && session()->get('type_user') == 1 ){
                session()->setFlashdata('err_message', 'You dont have the privileges');
                return redirect()->to('login')->with('fail', "You dont have the privileges");
            }
    
            // if($rol == 'company' && session()->get('type_user') != 2 ){
            //     session()->setFlashdata('err_message', 'You dont have the privileges 2');
            //     return redirect()->to('login')->with('fail', "You dont have the privileges");
            // }
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param array|null $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}