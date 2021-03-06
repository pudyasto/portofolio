<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Files\UploadedFile;
use phpDocumentor\Reflection\DocBlock\Tags\Example;

class Work extends BaseController
{

    protected $workModel;
    protected $title = 'Information';
    protected $state = '200';
    protected $message = 'Data Procesed';
    public function __construct()
    {
        $this->workModel = new \App\Models\WorkModel;
    }

    public function index()
    {
        return view('work/index');
    }

    public function formAdd()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('index');
        }
        // Show the form
        $data = array(
            'submit' => site_url('work/save'),
        );
        return view('work/form', $data);
    }

    public function formEdit()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('index');
        }
        $id = $this->request->getVar('id');
        // Show the form
        $data = array(
            'submit' => site_url('work/update'),
            'row' => $this->workModel->where('id', $id)->first(),
        );
        return view('work/form', $data);
    }

    public function jsonDataTable()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('index');
        }

        $get = $this->request->getVar();

        $columns = array(
            'company', 'position', 'date_start', 'description', 'date_finish', 'id'
        );
        $table = " (
            SELECT * FROM work WHERE deleted_at IS NULL
        ) AS a ";
        $index = "id";
        $output = $this->pawtable->output($get, $columns, $table, $index);
        return $output;
    }

    public function save()
    {
        try {
            if (!$this->validate([
                'company' => ['label' => 'Company', 'rules' => 'required|alpha_space'],
                'position' => ['label' => 'Position', 'rules' => 'required|alpha_space'],
                'date_start' => ['label' => 'Date Start', 'rules' => 'required|valid_date[d-m-Y]'],
                'description' => ['label' => 'Description', 'rules' => 'required|alpha_numeric_punct'],
            ])) {
                // Return error message from validation
                $validation = \Config\Services::validation();
                throw new \Exception($validation->listErrors());
            };
            $present = $this->request->getVar('present');
            if (!$present) {
                if (!$this->validate([
                    'date_finish' => ['label' => 'Date Finish', 'rules' => 'required|valid_date[d-m-Y]'],
                ])) {
                    // Return error message from validation
                    $validation = \Config\Services::validation();
                    throw new \Exception($validation->listErrors());
                };
                $date_finish = dateconvert($this->request->getVar('date_finish'));
            } else {
                $date_finish = null;
            }
            $data = [
                'company' => $this->request->getVar('company'),
                'position'    => $this->request->getVar('position'),
                'date_start'    => dateconvert($this->request->getVar('date_start')),
                'date_finish'    => $date_finish,
                'description'    => $this->request->getVar('description'),
            ];
            $this->workModel->save($data);
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
                'company' => ['label' => 'Company', 'rules' => 'required|alpha_space'],
                'position' => ['label' => 'Position', 'rules' => 'required|alpha_space'],
                'date_start' => ['label' => 'Date Start', 'rules' => 'required|valid_date[d-m-Y]'],
                'description' => ['label' => 'Description', 'rules' => 'required|alpha_numeric_punct'],
            ])) {
                // Return error message from validation
                $validation = \Config\Services::validation();
                throw new \Exception($validation->listErrors());
            };
            $present = $this->request->getVar('present');
            if (!$present) {
                if (!$this->validate([
                    'date_finish' => ['label' => 'Date Finish', 'rules' => 'required|valid_date[d-m-Y]'],
                ])) {
                    // Return error message from validation
                    $validation = \Config\Services::validation();
                    throw new \Exception($validation->listErrors());
                };
                $date_finish = dateconvert($this->request->getVar('date_finish'));
            } else {
                $date_finish = null;
            }
            $data = [
                'id' => $this->request->getVar('id'),
                'company' => $this->request->getVar('company'),
                'position'    => $this->request->getVar('position'),
                'date_start'    => dateconvert($this->request->getVar('date_start')),
                'date_finish'    => $date_finish,
                'description'    => $this->request->getVar('description'),
            ];
            $this->workModel->save($data);

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
            $this->workModel->where('id', $this->request->getVar('id'))->delete();

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
