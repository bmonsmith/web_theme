<?php
/* You can use formspree.io in the action form to have user input send you an email 
or just use this PHP page code */
include './dbconfig.php';
// code for check server side validation
$name = $comment = "";
//your site secret key
$secret = $secret
if (empty($_POST['comment']) AND ($_POST['name'])) {
     $comment = "";
    $name = "";
}
else if(isset ($_POST['comment']) AND ($_POST['name'] )){
    //&& $_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
    //get verified response data
    $param = "https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$_POST['g-recaptcha-response'];
    $verifyResponse = file_get_contents($param);
    $responseData = json_decode($verifyResponse);
    //use email server only for bmonsmith.com
    $comment = test_input($_POST['comment']);
    $name = test_input($_POST['name']);
    mail("oattool@bmonsmith.com", "My $name Fans", $comment);
if($responseData->success){
    // success
     function test_input($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    setcookie($_POST['name'], $_POST['comment'], time() + (86400 * 30), "contact.php"); // 86400 = 1 day
    if (isset($comment, $name)) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=epiz_28266067_myUserDB", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO MyGuests (GuestName, Message) VALUES ('$name', '$comment')";
            // use exec() because no results are returned
            $conn->exec($sql);
        }catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
        $conn = null;
    }
}
//use html to stop email spamming and ovload database leave the php pages
header("Location: http://bmonsmith.com/contact_pass.html");
