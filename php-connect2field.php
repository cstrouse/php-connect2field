<?php

class Connect2Field {
	
	const SDK_VERSION = '0.1';
	const API_VERSION = '2';
	
	private $url = 'https://apiv2.connect2field.com/C2FDataSvc.svc';
	
	private $username;
	private $password;

	public function __construct($username, $password) {
		$this->username = $username;
		$this->password = $password;
	}
	
	// builds URL endpoint for our request
	private function get_helper($obj) {
		$ch = curl_init($this->url . "/$obj");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-type: application/json',
			'Accept: application/json',
		));
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);
		return json_decode($response);
	}
	
	public function all_clients() {
		$response = $this::get_helper('Clients');
		return $response->d;
	}
	
	public function get_client($cust_id) {
		$response = $this::get_helper("Clients($cust_id)");
		return $response->d;
	}
	
	public function all_jobs($cust_id) {
		$response = $this::get_helper("Clients($cust_id)/Jobs");
		return $response->d;
	}
	
	public function get_job($cust_id, $job_id) {
		$response = $this::get_helper("Clients($cust_id)/Jobs($job_id)");
		return $response->d;
	}
	
}

?>