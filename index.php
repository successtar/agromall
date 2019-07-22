<?php

	define('BASEPATH', "/");

	/* Load library */

	require("library.php");

	/* New instance of the library class */

	$lib = new Library();

	$farmers_list = '';

	/* Load Homepage record via Agromall Api */

	$farmers = $lib->homepage();

	/* Load Homepage record from agromall.json file in this repo */

	//$farmers = $lib->local_record();

	/* Extract the first twenty data */

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

		/* Create Pagination */

		$paginate = '';

		$pages = round($farmers['data']['totalRec']/50);

		$paginate = '<li class="page-item">
		      <a class="page-link prev" href="#" aria-label="Previous" data-page="1">
		        <span aria-hidden="true">&laquo;</span>
		        <span class="sr-only">Previous</span>
		      </a>
		    </li>';

		for ($i=1; $i <= $pages; $i++){

			$paginate = $paginate.'<li class="page-item"><a class="page-link" href="#" data-page="'.$i.'">'.$i.'</a></li>';
		};

		$paginate = $paginate.'<li class="page-item">
							      <a class="page-link next" href="#" aria-label="Next"  data-page="2">
							        <span aria-hidden="true">&raquo;</span>
							        <span class="sr-only">Next</span>
							      </a>
							    </li>';

	}
	else{

		$farmers_list = '<p class="text-center">Farmers list not available at this time</p>';

	}




?>


<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Agro Mall Challenge</title>

	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">

</head>
<body>

<div id="container">

	<h5 class="px-5 py-4 text-center">Welcome to AgroMall Challenge</h5>
	<h4 class="pl-5 mb-5"> Farmers List</h4>


	<div class="container">
		<div id="spinner" class="text-center py-5">
			<div class="spinner-border text-danger p-4 " role="status">
              </div>
         </div>

		<div id="farmers" class="d-none mb-5">



			<div id="accordion">
			  
			  <?= $farmers_list ?>

			</div>
		</div>
	
		
		<nav aria-label="Page navigation " >
		  <ul class="pagination  overflow-auto">
		    <?= $paginate ?>
		  </ul>
		</nav>

	</div>


<script src="/js/jquery.js" ></script>
<script src="/js/bootstrap.min.js" ></script>
<script src="/js/main.js" ></script>

</body>
</html>