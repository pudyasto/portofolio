<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct()
	{
		$this->profileModel = new \App\Models\ProfileModel;
		$this->educationModel = new \App\Models\EducationModel();
		$this->productModel = new \App\Models\ProductModel();
		$this->skillModel = new \App\Models\SkillModel();
		$this->workModel = new \App\Models\WorkModel;
	}
	public function index()
	{
		$product = $this->productModel->findAll();
		$cat_product = array();
		foreach ($product as $val) {
			$cat_product[url_title($val['category'], '-', true)] = $val['category'];
		}
		$data = array(
			'profile' => $this->profileModel->first(),
			'education' => $this->educationModel->orderBy('date_start', 'DESC')->findAll(),
			'product' => $product,
			'cat_product' => $cat_product,
			'skill' => $this->skillModel->findAll(),
			'work' => $this->workModel->orderBy('date_start', 'DESC')->findAll(),
		);
		return view('home/index', $data);
	}

	public function getData()
	{
		// Requset must from ajax
		if ($this->request->isAJAX()) {
			$data = $this->profileModel->first();
			if ($data) {
				$arr = [
					'full_name' => $data['full_name'],
					'birth_year'    => ', ' . hitung_umur($data['birth_date'], null, 'Y'),
					'birth'    => $data['birth_place'] . ',' . datetime_id($data['birth_date']),
					'phone'    => 'Phone : ' . $data['phone'],
					'email'    => 'Email : ' . $data['email'],
					'linkedin'    => $data['linkedin'],
					'instagram'    => $data['instagram'],
					'facebook'    => $data['facebook'],
					'twitter'    => $data['twitter'],
					'quotes'    => $data['quotes'],
					'about_me'    => $data['about_me'],
					'photo' => photo_profile(),
				];
				return json_encode($arr);
			}
		} else {
			return redirect()->to('index');
		}
	}
	//--------------------------------------------------------------------

}
