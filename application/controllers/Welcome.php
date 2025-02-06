<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sample_model');
	}
	public function index()
	{
		$data['info'] = $this->sample_model->get_records();
		$this->load->view('welcome_message', $data);
	}

	public function save_data()
	{
		$error = '';
		$success = '';

		$insert_data = array(
			'username' => $this->input->post('username', true),
			'firstname' => $this->input->post('firstname', true),
			'lastname' => $this->input->post('lastname', true),
			'email' => $this->input->post('email', true),

		);

		$result = $this->sample_model->save_data($insert_data);
		if ($result) {
			$success = 'Success';
		} else {
			$error = 'Failed to save';
		}

		$output = array(
			'error' => $error,
			'success' => $success,
		);

		echo json_encode($output);

	}

	public function get_record($id)
	{
		$data['record'] = $this->sample_model->get_record($id);

		echo json_encode($data['record']);
	}

	public function update_data()
	{
		$error = '';
		$success = '';

		$id = $this->input->post('id', true);

		$update_data = array(
			'username' => $this->input->post('username', true),
			'firstname' => $this->input->post('firstname', true),
			'lastname' => $this->input->post('lastname', true),
			'email' => $this->input->post('email', true),
		);

		$result = $this->sample_model->update_data($update_data, $id);
		if ($result) {
			$success = 'Updated';
		} else {
			$error = 'Failed to update';
		}

		$output = array(
			'error' => $error,
			'success' => $success,
		);

		echo json_encode($output);
	}
}
