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
	
	/* Clients */
	public function all_clients() {
		$response = $this::get_helper('Clients');
		return $response->d;
	}
	
	public function get_client($cust_id) {
		$response = $this::get_helper("Clients($cust_id)");
		return $response->d;
	}
	
	/* Jobs */
	public function all_jobs($cust_id) {
		$response = $this::get_helper("Clients($cust_id)/Jobs");
		return $response->d;
	}
	
	public function get_job($cust_id, $job_id) {
		$response = $this::get_helper("Clients($cust_id)/Jobs($job_id)");
		return $response->d;
	}
	
	/* Invoices */
	public function all_invoices() {
		$response = $this::get_helper("Invoices");
		return $response->d;
	}
	
	public function get_invoice($id) {
		$response = $this::get_helper("Invoices($id)");
		return $response->d;
	}
	
	/* Account types */
	public function all_account_types() {
		$response = $this::get_helper("AccountTypeMs");
		return $response->d;
	}
	
	public function get_account_type($id) {
		$response = $this::get_helper("AccountTypeMs($id)");
		return $response->d;
	}
	
}

?>