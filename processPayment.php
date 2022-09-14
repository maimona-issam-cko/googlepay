<?php


$bigData = json_decode($_POST['googlePaymentData']);


    $url = "https://api.sandbox.checkout.com/tokens";
	$ch = curl_init($url);
	$header = array(
    'Content-Type: application/json;charset=UTF-8',
    'Authorization: pk_test_934238f0-0858-43d5-a109-f2fb18f0291a'
                                            );
                                            

$data_string = "{
  \"type\": \"googlepay\",
  \"token_data\":".$_POST['googlePaymentData']."
}";




	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $output = curl_exec($ch);
	
	

    curl_close($ch);
    $decoded = json_decode($output,true);

	

	$url = "https://api.sandbox.checkout.com/payments";
	$ch = curl_init($url);
	$header = array(
    'Content-Type: application/json;charset=UTF-8',
    'Authorization: sk_test_7316ef4f-c8ce-42a1-af04-6273f3478a63');

	
	$data_string = '{
  "source": {
    "type": "token",
    "token": "'.$decoded['token'].'"
  },
  "amount": 100,
  "currency": "SAR",
  "reference": "sew_w4ewrwr324"
}';
	
	
	

	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER , true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $output = curl_exec($ch);
	
	
	
    curl_close($ch);
    $decoded = json_decode($output,true);

	
////////////////////////////////////////////////////
//API CALL DONE, BELOW HTML IS ONLY FOR FORMATTING
////////////////////////////////////////////////////



?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Frames</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
  <div class="container-fluid">
	<div class="page-header">
		<h1> Transaction response: </h1>
	</div>
	
			<div class="row">
				<div class="col-sm-8">
					<div ng-app="">

			  <table class="table table-striped">
    <thead>
      <tr>
        <th>Field Name : </th>
        <th>Value </th>

      </tr>
    </thead>
    <tbody>
     
        <?php
		
		foreach($decoded as $k => $v){
			
			switch(gettype($v)){
				case "NULL": echo " ";
				break;
				case "array": 
				
				echo "<tr>";
					
						echo"
						
							<td>".$k."</td><td>";
							
							foreach($v as $key => $value){
						echo $key. ": " .$value,"<br>";
					}
					break;
					
					echo "</td>";
					echo "</tr>";
					
				case "string":
						echo "<tr>";
					
						echo"
						
							<td>".$k."</td><td>".$v."</d>
						
						";
					
						echo "</tr>";
				
				default : continue;
				
				
			}
			
			
			
			
		}
     
?>
    </tbody>
  </table>
					</div>

				</div>
			</div>

			
			
	
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>  
	</body>
</html>


