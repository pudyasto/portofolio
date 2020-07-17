<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Files\UploadedFile;
use phpDocumentor\Reflection\DocBlock\Tags\Example;

class Skill extends BaseController
{

    protected $skillModel;
    protected $title = 'Information';
    protected $state = '200';
    protected $message = 'Data Procesed';
    public function __construct()
    {
        $this->skillModel = new \App\Models\SkillModel;
    }

    public function index()
    {
        return view('skill/index');
    }

    public function formAdd()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('index');
        }
        // Show the form
        $data = array(
            'submit' => site_url('skill/save'),
        );
        return view('skill/form', $data);
    }

    public function formEdit()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('index');
        }
        $id = $this->request->getVar('id');
        // Show the form
        $data = array(
            'submit' => site_url('skill/update'),
            'row' => $this->skillModel->where('id', $id)->first(),
        );
        return view('skill/form', $data);
    }

    public function jsonDataTable()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('index');
        }

        $get = $this->request->getVar();

        $columns = array(
            'name', 'description', 'percent', 'id'
        );
        $table = " (
            SELECT * FROM skill WHERE deleted_at IS NULL
        ) AS a ";
        $index = "id";
        $output = $this->pawtable->output($get, $columns, $table, $index);
        return $output;
    }

    public function save()
    {
        try {
            if (!$this->validate([
                'name' => ['label' => 'Skill Name', 'rules' => 'required|alpha_space'],
                'description' => ['label' => 'Description', 'rules' => 'required|alpha_numeric_punct'],
                'percent' => ['label' => 'Point', 'rules' => 'required|is_natural|greater_than_equal_to[0]|less_than_equal_to[100]'],
            ])) {
                // Return error message from validation
                $validation = \Config\Services::validation();
                throw new \Exception($validation->listErrors());
            };
            $data = [
                'name' => $this->request->getVar('name'),
                'percent'    => $this->request->getVar('percent'),
                'description'    => $this->request->getVar('description'),
            ];
            $this->skillModel->save($data);
            $this->message = 'Data Saved';
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

    public function update()
    {
        try {
            if (!$this->validate([
                'id' => ['label' => 'Product ID', 'rules' => 'required|numeric'],
                'name' => ['label' => 'Skill Name', 'rules' => 'required|alpha_space'],
                'description' => ['label' => 'Description', 'rules' => 'required|alpha_numeric_punct'],
                'percent' => ['label' => 'Point', 'rules' => 'required|is_natural|greater_than_equal_to[0]|less_than_equal_to[100]'],
            ])) {
                // Return error message from validation
                $validation = \Config\Services::validation();
                throw new \Exception($validation->listErrors());
            };
            $data = [
                'id' => $this->request->getVar('id'),
                'name' => $this->request->getVar('name'),
                'percent'    => $this->request->getVar('percent'),
                'description'    => $this->request->getVar('description'),
            ];
            $this->skillModel->save($data);

            $this->message = 'Data Updated';
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

    public function delete()
    {
        try {
            if (!$this->validate([
                'id' => ['label' => 'Product ID', 'rules' => 'required|numeric'],
                'stat' => ['label' => 'State', 'rules' => 'required|alpha_space'],
            ])) {
                // Return error message from validation
                $validation = \Config\Services::validation();
                throw new \Exception($validation->listErrors());
            };
            $this->skillModel->where('id', $this->request->getVar('id'))->delete();

            $this->message = 'Data Deleted';
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
}
