<?php

namespace App\Controllers;
use App\Models\UserModel;


class Home extends BaseController
{
    // public function index()
    // {
    //     return view('welcome_message');
    // }

    public function user_list()
    {   
        $UserModel = new UserModel();
        $data['users'] = $UserModel->orderBy('id', 'DESC')->findAll();

        echo view('include/header');
        echo view('dashboard', $data);
        echo view('include/footer');
    }

    public function store()
    {   
        $UserModel = new UserModel();

        $data = [
            'name' => $this->request->getVar('name'),
            'address' => $this->request->getVar('address'),
            'salary' => $this->request->getVar('salary')
        ];

        $UserModel->insert($data);
        return $this->response->redirect(site_url('/user-list'));

    }


    public function edit_data()
    {
         $userModel = new UserModel();

         $id = $this->request->getVar('id');

         $data = $userModel->where('id', $id)->first();

         echo json_encode($data);
         
    }


    // update user data
    public function update_data(){

        $UserModel = new UserModel();
        $id = $this->request->getVar('id');

        $data = [
            'name' => $this->request->getVar('name'),
            'address'  => $this->request->getVar('address'),
            'salary'  => $this->request->getVar('salary')
        ];

        $UserModel->update($id, $data);
        return $this->response->redirect(site_url('/user-list'));
    }



    public function delete_data()
    {
        $UserModel = new UserModel();

        $id = $this->request->getVar('id');

        $data['user'] = $UserModel->where('id', $id)->delete($id);

        print_r($data['user']);
    }

}?>
