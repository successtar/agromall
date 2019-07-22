<?php

	define('BASEPATH', "/");

	/* Load library */

	require("../library.php");

	/* New instance of the library class */

	$lib = new Library();

	$farmers_list = '';

	/* Ajax request method */

	if ($_GET['page'] > 0){

		/* Load requested page record via Agromall Api */

		$farmers = $lib->page($_GET['page']);

		/* Load requested page record from agromall.json file in this repo */

		//$farmers = $lib->local_record($_GET['page']);

		/* Extract the data obtained */

		if (isset($farmers['data']['farmers'])){

			for ($i=0; $i < count($farmers['data']['farmers']); $i++){

				$farmers_list = $farmers_list.

					'<div class="card">
					    <div class="card-header" id="headingOne">
					      <h5 class="mb-0">
					        <button class="btn btn-link" data-toggle="collapse" data-target="#x'.$farmers['data']['farmers'][$i]['farmer_id'].'" aria-expanded="true" aria-controls="collapseOne">
					          '.$farmers['data']['farmers'][$i]['surname'].' '.$farmers['data']['farmers'][$i]['first_name'].' '.$farmers['data']['farmers'][$i]['middle_name'].'
					        </button>
					        <button class="btn btn-sm btn-primary float-right delete-farmer">
					        	Delete
					        </button>

					      </h5>
					    </div>

					    <div id="x'.$farmers['data']['farmers'][$i]['farmer_id'].'" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
					      <div class="card-body">
					        <table class="table">
							  <tbody class="mx-5">
							  	<tr>
							  		<th colspan="2"  class="border-0 text-center py-5">
							  			<img src="https://s3-eu-west-1.amazonaws.com/agromall-storage/'.$farmers['data']['farmers'][$i]['passport_photo'].'" height= "120px" width="150px" alt="'.$farmers['data']['farmers'][$i]['surname'].' Image" />
							  		</th>
							  	</tr>
							    <tr>
							      <th scope="row">Registration No</th>
							      <td>'.$farmers['data']['farmers'][$i]['reg_no'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">BVN</th>
							      <td>'.$farmers['data']['farmers'][$i]['bvn'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Date of Birth</th>
							      <td>'.$farmers['data']['farmers'][$i]['dob'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Gender</th>
							      <td>'.$farmers['data']['farmers'][$i]['gender'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Nationality</th>
							      <td>'.$farmers['data']['farmers'][$i]['nationality'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Occupation</th>
							      <td>'.$farmers['data']['farmers'][$i]['occupation'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Marital Status</th>
							      <td>'.$farmers['data']['farmers'][$i]['marital_status'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Spouse Name</th>
							      <td>'.$farmers['data']['farmers'][$i]['spouse_name'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Address</th>
							      <td>'.$farmers['data']['farmers'][$i]['address'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">City</th>
							      <td>'.$farmers['data']['farmers'][$i]['city'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Local Government Area</th>
							      <td>'.$farmers['data']['farmers'][$i]['lga'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">State</th>
							      <td>'.$farmers['data']['farmers'][$i]['state'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Phine Number</th>
							      <td>'.$farmers['data']['farmers'][$i]['mobile_no'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Email Address</th>
							      <td>'.$farmers['data']['farmers'][$i]['email_address'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Means of Identity</th>
							      <td>'.$farmers['data']['farmers'][$i]['id_type'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Id Number</th>
							      <td>'.$farmers['data']['farmers'][$i]['id_no'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Issue Date</th>
							      <td>'.$farmers['data']['farmers'][$i]['issue_date'].'</td>
							    </tr>
							    <tr>
							      <th scope="row">Expiry Date</th>
							      <td>'.$farmers['data']['farmers'][$i]['expiry_date'].'</td>
							    </tr>
							  </tbody>
							</table>
					      </div>
					    </div>
					</div>';
		}
	}
	else{

		$farmers_list = '<p class="text-center">No data found</p>';
	}

	echo $farmers_list;

}

	

?>