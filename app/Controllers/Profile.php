<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Files\UploadedFile;
use phpDocumentor\Reflection\DocBlock\Tags\Example;

class Profile extends BaseController
{

    protected $profileModel;
    protected $title = 'Information';
    protected $state = '200';
    protected $message = 'Data Procesed';
    public function __construct()
    {
        $this->profileModel = new \App\Models\ProfileModel;
    }

    public function index()
    {
        $data = array(
            'profile' => $this->profileModel->first(),
        );
        return view('profile/index', $data);
    }

    public function form()
    {
        // Show the form
        $data = array(
            'submit' => site_url('profile/submit'),
            'profile' => $this->profileModel->first(),
        );
        return view('profile/form', $data);
    }

    public function submit()
    {
        try {
            if (!$this->validate([
                'full_name' => ['label' => 'Full Name', 'rules' => 'required|alpha_space'],
                'birth_date' => ['label' => 'Birth Date', 'rules' => 'required|valid_date[d-m-Y]'],
                'birth_place' => ['label' => 'Birth Place', 'rules' => 'required|alpha_space'],
                'phone' => ['label' => 'Phone', 'rules' => 'required|alpha_numeric_punct'],
                'email' => ['label' => 'Email', 'rules' => 'required|valid_email'],
                'address' => ['label' => 'Address', 'rules' => 'required|alpha_numeric_punct'],
                'city' => ['label' => 'City', 'rules' => 'required|alpha_numeric_punct'],
                'linkedin' => ['label' => 'Linkedin', 'rules' => 'valid_url'],
                'instagram' => ['label' => 'Instagram', 'rules' => 'valid_url'],
                'facebook' => ['label' => 'Facebook', 'rules' => 'valid_url'],
                'twitter' => ['label' => 'Twitter', 'rules' => 'valid_url'],
                'quotes' => ['label' => 'Quotes', 'rules' => 'required|alpha_numeric_punct'],
                'about_me' => ['label' => 'About Me', 'rules' => 'required|alpha_numeric_punct'],
            ])) {
                // Return error message from validation
                $validation = \Config\Services::validation();
                throw new \Exception($validation->listErrors());
            };
            $data = [
                'full_name' => $this->request->getVar('full_name'),
                'birth_date'    => dateconvert($this->request->getVar('birth_date')),
                'birth_place'    => $this->request->getVar('birth_place'),
                'phone'    => $this->request->getVar('phone'),
                'email'    => $this->request->getVar('email'),
                'address'    => $this->request->getVar('address'),
                'city'    => $this->request->getVar('city'),
                'linkedin'    => $this->request->getVar('linkedin'),
                'instagram'    => $this->request->getVar('instagram'),
                'facebook'    => $this->request->getVar('facebook'),
                'twitter'    => $this->request->getVar('twitter'),
                'quotes'    => $this->request->getVar('quotes'),
                'about_me'    => $this->request->getVar('about_me'),
            ];


            $is_exist = $this->profileModel->first();
            $photo = $this->request->getFile('photo');
            if ($is_exist) {
                // If using ID then Update Data
                if ($photo) {
                    $this->saveFile($photo);
                }
                $data['id'] = $is_exist['id'];
                $this->profileModel->save($data);
                $this->message = 'Data Updated';
            } else {
                // Insert New Data
                if (!$photo) {
                    throw new \Exception("Photo required");
                }
                $this->saveFile($photo);
                $this->profileModel->save($data);
                $this->message = 'Data Saved';
            }
        } catch (\Exception $e) {
            $this->title = "Error";
            $this->message = $e->getMessage();
            $this->state = "500";
        }

        $arr = array(
            'title' => $this->title,
            'state' => $this->state,
            'message' => $this->message,
            'data' => null,
            'csrf_return' => csrf_hash(),
        );
        return json_encode($arr);
    }

    protected function saveFile($file)
    {
        array_map('unlink', glob(ROOTPATH . 'public/uploads/profile*'));
        $file->move(ROOTPATH . 'public/uploads', 'profile.' . $file->getExtension());
    }
}
