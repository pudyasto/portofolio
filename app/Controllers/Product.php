<?php

namespace App\Controllers;

use CodeIgniter\HTTP\Files\UploadedFile;
use phpDocumentor\Reflection\DocBlock\Tags\Example;

class Product extends BaseController
{

    protected $productModel;
    protected $title = 'Information';
    protected $state = '200';
    protected $message = 'Data Procesed';
    public function __construct()
    {
        $this->productModel = new \App\Models\ProductModel;
    }

    public function index()
    {
        return view('product/index');
    }

    public function formAdd()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('index');
        }
        // Show the form
        $data = array(
            'submit' => site_url('product/save'),
        );
        return view('product/form', $data);
    }

    public function formEdit()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('index');
        }
        $id = $this->request->getVar('id');
        // Show the form
        $data = array(
            'submit' => site_url('product/update'),
            'row' => $this->productModel->where('id', $id)->first(),
        );
        return view('product/form', $data);
    }

    public function jsonDataTable()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->to('index');
        }

        $get = $this->request->getVar();

        $columns = array(
            'id', 'category', 'name', 'description', 'image',
        );
        $table = " (
            SELECT * FROM product WHERE deleted_at IS NULL
        ) AS a ";
        $index = "id";
        $output = $this->pawtable->output($get, $columns, $table, $index);
        return $output;
    }

    public function save()
    {
        try {
            if (!$this->validate([
                'category' => ['label' => 'Product Category', 'rules' => 'required|alpha_space'],
                'name' => ['label' => 'Product Name', 'rules' => 'required|alpha_space'],
                'description' => ['label' => 'Description', 'rules' => 'required|alpha_numeric_punct'],
                'image' => ['label' => 'Product Images', 'rules' => 'uploaded[image]|max_size[image,5120]|is_image[image]'],
            ])) {
                // Return error message from validation
                $validation = \Config\Services::validation();
                throw new \Exception($validation->listErrors());
            };
            $data = [
                'category' => $this->request->getVar('category'),
                'name'    => $this->request->getVar('name'),
                'description'    => $this->request->getVar('description'),
            ];
            $this->productModel->save($data);
            $id = $this->productModel->insertID();
            $photo = $this->request->getFile('image');
            $this->saveFile($photo, $id);

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
                'category' => ['label' => 'Product Category', 'rules' => 'required|alpha_space'],
                'name' => ['label' => 'Product Name', 'rules' => 'required|alpha_space'],
                'description' => ['label' => 'Description', 'rules' => 'required|alpha_numeric_punct'],
            ])) {
                // Return error message from validation
                $validation = \Config\Services::validation();
                throw new \Exception($validation->listErrors());
            };
            $data = [
                'id' => $this->request->getVar('id'),
                'category' => $this->request->getVar('category'),
                'name'    => $this->request->getVar('name'),
                'description'    => $this->request->getVar('description'),
            ];
            $photo = $this->request->getFile('image');
            if ($photo) {
                // If User Upload image then validate!
                if (!$this->validate([
                    'image' => ['label' => 'Product Images', 'rules' => 'uploaded[image]|max_size[image,5120]|is_image[image]'],
                ])) {
                    // Return error message from validation
                    $validation = \Config\Services::validation();
                    throw new \Exception($validation->listErrors());
                };
                $this->saveFile($photo, $data['id']);
            }
            $this->productModel->save($data);

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
            $this->productModel->where('id', $this->request->getVar('id'))->delete();

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

    protected function saveFile($file, $id)
    {
        array_map('unlink', glob(ROOTPATH . "public/uploads/products/{$id}*"));
        $filename = $id . '.' . $file->getExtension();
        $file->move(ROOTPATH . 'public/uploads/products/', $filename);

        // Update image file name
        $data = [
            'id' => $id,
            'image' => $filename,
        ];
        $this->productModel->save($data);
    }
}
