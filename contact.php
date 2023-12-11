<?php
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['email'], $_POST['message']) === true) {

$ipaddress = $_SERVER['REMOTE_ADDR'];
$date = date('d/m/Y');
$time = date('H:i:s');
$headers = "From: info@example.com" . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING)

if (empty($name) === true) {
    $errors['name'][] = 'Name is empty';
} elseif (ctype_alpha($name) === false) {
    $errors['name'][] = 'Name contains invalid characters';
}


$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

if (empty($email) === true) {
    $errors['email'][] = 'Email is empty';
} elseif ($email === false) {
    $errors['email'][] = 'Invalid email address';
}


$subject = $_POST['subject'];

$message = strip_tags(trim($_POST['message']));

if (count($errors) === 0) {
    echo 'Thank you! Message has been sent';
    $emailbody = "<p>You have recieved a new message from the enquiries form on your portfolio website.</p> 
    <p><strong>Name: </strong> {$name} </p> 
    <p><strong>Email Address: </strong> {$email} </p> 
    <p><strong>Message: </strong> {$message} </p> 
    <p>This message was sent from the IP Address: {$ipaddress} on {$date} at {$time}</p>";
    // mail("mike.minikowski@gmail.com", "New Enquiry From Portfolio Site", $emailbody, $headers)

}

if (count($errors) > 0) {
    foreach ($errors as $field => $messages) {
        echo implode(', ', $messages), '<br>';
    }
}

}
?>