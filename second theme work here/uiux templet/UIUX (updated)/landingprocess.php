<style>
    #nextel_form{ display:none;}
</style>
<?php 

require_once('../../whatsapp_class.php');
$name=trim($_POST['name']);
$phone=trim($_POST['phone']);
$email=trim($_POST['email']);
$whatsapp_obj = new WhatsAppAPI();
$apiResponse = $whatsapp_obj->sendText($country_code = '91', $to_mobile = $phone, $message = 'Thanks for your UI/Ux course interest at TGC INDIA, Please let us know more about your learning requirements? ');


$toaddress='info@tgcindia.com,tgcanimation@gmail.com';
$subject1=' Inquiry from TGC  UI/Ux Course Page ';  //changes for the heading subject
$mailcontent=' Email:'. $email .' Send you mail from UI/Ux Course' ." \n ".'Phone: '. $phone ." \n " .' name: '. $name ." \n ";  //content on mail here
$success=mail($toaddress,$subject1,$mailcontent,"From:$email");
$toaddress3='tgcanimation@gmail.com';
mail($toaddress3,$subject1,$mailcontent,"From:$email");
$toaddress2='ranjan354@gmail.com';
mail($toaddress2,$subject1,$mailcontent,"From:$email");
include_once('../../config.php');
$query="select email from `maillist` where email='$email'";
$result=mysqli_query($con,$query);
	$t=date("Y-m-d-H-i");
	$area='Inquiry from TGC Adword';
	$queryinsert= "INSERT INTO `maillist` (`name`, `email`, `phone`, `area`, `date`,`comments` ) VALUES ('$name','$email','$phone','$area','$t','')";
	mysqli_query($con,$queryinsert);
 $nid = mysqli_insert_id();	
 if($success){
	header("Location:https://www.tgcindia.com/thanks"); 
 }
?>
<div id="nextel_form">
<?php
$url = 'https://app.nextel.io/webhook/insert/b7892fb3c2f009c65f686f6355c895b5';
$fields = array(
	'name' => $name,
	'phone' => $phone,
	'email' => $email,	
);

$ch = curl_init();


curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query( $fields ));


$result = curl_exec($ch);

curl_close($ch);
?>

</div>