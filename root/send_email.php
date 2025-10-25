<?php
// Get the POSTed JSON data
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email']) || !isset($data['imageData'])) {
    echo "Invalid request!";
    exit;
}

$to = $data['email'];
$from = "wics@uwindsor.ca";
$subject = "Your WiCS Binary Bead Layout";
$message = "Hi! \n Attached is your custom binary bead layout from the Women in Computer Science Club. \n Hope you love  your bracelet and enjoy the Open House! \n\n - WiCS at University of Windsor";

// Decode the base64 image
$imageData = $data['imageData'];
$imageParts = explode(";base64,", $imageData);
$imageBase64 = $imageParts[1];
$imageDecoded = base64_decode($imageBase64);

// Create a unique filename
$filename = "my-binary-bead-layout.png";

// Boundary for multipart email
$separator = md5(time());

// Headers
$headers  = "From: WiCS <{$from}>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"{$separator}\"\r\n";

// Message body
$body = "--{$separator}\r\n";
$body .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$body .= $message . "\r\n";

// Attachment
$body .= "--{$separator}\r\n";
$body .= "Content-Type: image/png; name=\"{$filename}\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "Content-Disposition: attachment; filename=\"{$filename}\"\r\n\r\n";
$body .= chunk_split(base64_encode($imageDecoded)) . "\r\n";
$body .= "--{$separator}--";

// Send email
if (mail($to, $subject, $body, $headers)) {
    echo "Email sent successfully to {$to}!";
} else {
    echo "Failed to send email.";
}
?>
