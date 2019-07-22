<?php

/* Prevent Direct Access */

defined('BASEPATH') OR exit('No direct script access allowed');


class Library{

	/* Agromall api endpoint */

	public $host = "https://theagromall.com/api/v2/get-sample-farmers";

	private function all_farmers(){

		/* Load record from file */

		return json_decode(file_get_contents(__Dir__.'/agromall.json'), true);

	}

	public function local_record($page=1, $limit=50){

		$farmers = array();

		$all = $this->all_farmers();

		/* Start */

		$i = ($page - 1) * $limit;

		/* End */

		$j = $page * $limit;

		while ($i < count($all['data']['farmers']) && $i < $j){

			$farmers[] = $all['data']['farmers'][$i];

			$i++;
		}

		/* Prepare response in exact format as will be obtained via agromall api */

		return array(
						'status' => 'true', 

						'data' => array(
											'farmers' => $farmers,

											'totalRec' => $all['data']['totalRec']
										),

						'imageBaseUrl' => $all['imageBaseUrl']
					);
	}

	public function homepage(){

		/* Set limit */

		$req_data = array(
							'limit' => 50,

							'page' => 1
						);



		return $this->curl_req($req_data);
	}


	public function page($page=1){

		/* Set limit */

		$req_data = array(
							'limit' => 50,

							'page' => $page
						);



		return $this->curl_req($req_data);
	}



	private function curl_req($data){
		
		
		/* Curl options for request sent from from this class */
		
		$options = array(

					CURLOPT_POST => 1,

					CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
					
					CURLOPT_POSTFIELDS => json_encode($data),

					CURLOPT_FOLLOWLOCATION => true,   // follow redirects
					
					CURLOPT_RETURNTRANSFER => 1,	  //Return data
					
					CURLOPT_MAXREDIRS      => 2,     // stop after 2 redirects
					
					CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
					
					CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
				
					CURLOPT_TIMEOUT        => 120,    // time-out on response
				); 
		
		$ch = curl_init($this -> host);
		
		curl_setopt_array($ch, $options);
    	
		/* Execute request and return the response with transaction informations */
		
    	$content  = json_decode(curl_exec($ch), true);

    	/* Check for success and return response as appropriate */

    	return isset($content['status']) ? $content : array('status' => 'error');
	}

	
}


















?>