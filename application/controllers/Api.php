<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Api Controller
|--------------------------------------------------------------------------
|
| Digunakan untuk menampilkan data menggunakan AJAX
|
*/

class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Load Model
		$this->load->model('m_guest', 'guest');
	}

	// Menampilkan semua data tempat
	public function getAllPlaces()
	{
		$place = $this->guest->getAllPlaces()->result();

		// Menampilkan output dalam bentuk JSON
		return $this->output
								->set_status_header(200) // Respon HTTP Success
								->set_output(json_encode([
										'success' => true,
										'message' => 'Success get all recommend place',
										'data' => $place
									]));
	}

	// Menampilkan semua data area
	public function getAllAreas()
	{
		$area = $this->guest->getAllAreas()->result();

		// Menampilkan output dalam bentuk JSON
		return $this->output
								->set_status_header(200)
								->set_output(json_encode([
										'success' => true,
										'message' => 'Success get all recommend area',
										'data' => $area
									]));
	}

	// Menampilkan satu data tempat
	public function getOnePlace($id)
	{
		$place = $this->guest->getOnePlace($id)->row();

		if ($place === null) {
			// Menampilkan output dalam bentuk JSON
			return $this->output
									->set_status_header(404) // Status HTTP Not Found
									->set_output(json_encode([
											'success' => false,
											'message' => 'Not found'
										]));

		} else {
			// Menampilkan output dalam bentuk JSON
			return $this->output
									->set_status_header(200)
									->set_output(json_encode([
											'success' => true,
											'message' => 'Success get one place',
											'data' => $place
										]));
		}
	}

	// Menampilkan satu data area
	public function getOneArea($id)
	{
		$area = $this->guest->getOneArea($id)->row();

		if ($area === null) {
			// Menampilkan output dalam bentuk JSON
			return $this->output
									->set_status_header(404)
									->set_output(json_encode([
											'success' => false,
											'message' => 'Not found'
										]));

		} else {
			// Menampilkan output dalam bentuk JSON
			return $this->output
									->set_status_header(200)
									->set_output(json_encode([
											'success' => true,
											'message' => 'Success get one area',
											'data' => $area
										]));
		}
	}

	// Simpan tempat
	public function storePlace()
	{
		$name = $this->input->post('name');
		$place = $this->input->post('place');
		$address = $this->input->post('address');
		$lat = $this->input->post('lat');
		$lng = $this->input->post('lng');

		$data = [
			'name' => $name,
			'place' => $place,
			'address' => $address,
			'lat' => $lat,
			'lng' => $lng
		];

		$result = $this->guest->storePlace($data);

		if (!$result) {
			// Menampilkan output dalam bentuk JSON
			return $this->output
									->set_status_header(500) // Status HTTP Error
									->set_output(json_encode([
											'success' => false,
											'message' => 'Error'
										]));

		} else {
			// Menampilkan output dalam bentuk JSON
			return $this->output
									->set_status_header(201)
									->set_output(json_encode([
											'success' => true,
											'message' => 'Success save place'
										]));
		}
	}

	// Simpan area
	public function storeArea()
	{
		$name = $this->input->post('name');
		$area_name = $this->input->post('area_name');
		$area_type = $this->input->post('area_type');
		$area = $this->input->post('area');

		$data = [
			'name' => $name,
			'area_name' => $area_name,
			'area_type' => $area_type,
			'area' => $area
		];

		$result = $this->guest->storeArea($data);

		if (!$result) {
			// Menampilkan output dalam bentuk JSON
			return $this->output
									->set_status_header(500)
									->set_output(json_encode([
											'success' => false,
											'message' => 'Error'
										]));

		} else {
			// Menampilkan output dalam bentuk JSON
			return $this->output
									->set_status_header(201) // Status HTTP Success Created
									->set_output(json_encode([
											'success' => true,
											'message' => 'Success save place'
										]));
		}
	}

	// Menghapus tempat
	public function destroyPlace($id)
	{
		$result = $this->guest->deletePlace($id);

		if (!$result) {
			return $this->output
									->set_status_header(500)
									->set_output(json_encode([
											'success' => false,
											'message' => 'Error'
										]));

		} else {
			return $this->output
									->set_status_header(201)
									->set_output(json_encode([
											'success' => true,
											'message' => 'Success delete place'
										]));
		}
	}

	// Menghapus area
	public function destroyArea($id)
	{
		$result = $this->guest->deleteArea($id);

		if (!$result) {
			return $this->output
									->set_status_header(500)
									->set_output(json_encode([
											'success' => false,
											'message' => 'Error'
										]));

		} else {
			return $this->output
									->set_status_header(201)
									->set_output(json_encode([
											'success' => true,
											'message' => 'Success delete area'
										]));
		}
	}
}
