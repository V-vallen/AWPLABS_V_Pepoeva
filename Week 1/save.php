<?php
    $host = 'mysql.metropolia.fi';
    $dbname = ''; // your username
    $user = ''; // your username
    $pass = ''; // your database password
	
   // TODO: get the data from the form by using $_POST
   $data = array();
   $data['name']= $_POST['name'];
   $data['description']= $_POST['desc'];
   $data['email']= $_POST['email'];
   $data['cell']= $_POST['cell'];
   $date=$_POST['date'];
   $time=$_POST['time'];
   $data['sqlDate'] = date ("Y-m-d H:i:s", strtotime($date.' '.$time));
  
   
   
   // this is how you convert the date from the form to SQL formatted date:
   // date ("Y-m-d H:i:s", strtotime(dataFromDateField.' '.dataFromTimeField));
   
// this part was in dbConnect.php in last period:
try {

	$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$DBH->query("SET NAMES 'UTF8';");

}catch(PDOException $e) {

	echo "Could not connect to database.";
	file_put_contents('log.txt', $e->getMessage(), FILE_APPEND);
}

    
try {
	$STH=$DBH->prepare("INSERT INTO calendar( 	
	eName,
	eDescription,
	pEmail,
	pPhone,
	eDate
)
VALUES(
 	:name,
 	:description,
	:email,
	:cell,
	:sqlDate);");
	$STH->execute($data);

	// TODO: insert the data from the form to database table 'calendar'
	/*$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
	$DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$DBH->query(	
	"INSERT INTO calendar( 	
	eName,
	eDescription,
	pEmail,
	pPhone,
	eDate
)
VALUES(
 	'$name',
 	'$desc',
	'$email',
	'$cell',
	'$date_format'
	
);");
$DBH= new PDO('mysql');*/
} catch (PDOException $e) {
	echo 'Something went wrong';
	file_put_contents('log.txt', $e->getMessage()."\n\r", FILE_APPEND); // remember to set the permissions so that log.txt can be created
}
?>