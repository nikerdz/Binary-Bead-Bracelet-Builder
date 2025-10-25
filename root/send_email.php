<?php
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email']) || !isset($data['imageData'])) {
    echo "Invalid request!";
    exit;
}

$to = $data['email'];
$from = "wics@uwindsor.ca";
$subject = "Your WiCS Binary Bead Layout";
$message = "Hi! \n\nAttached is your custom binary bead layout from the Women in Computer Science Club. \nHope you love your new bracelet and enjoy the Open House! \n\n - WiCS at University of Windsor";

// Decode base64 image
$imageData = $data['imageData'];
$imageParts = explode(";base64,", $imageData);
$imageBase64 = $imageParts[1];
$imageDecoded = base64_decode($imageBase64);

// Create a temporary file
$tmpFile = tempnam(sys_get_temp_dir(), 'bead') . '.png';
file_put_contents($tmpFile, $imageDecoded);

// Create headers for attachment
$separator = md5(time());
$headers  = "From: WiCS <{$from}>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"{$separator}\"\r\n";

// Body with text + attachment
$body = "--{$separator}\r\n";
$body .= "Content-Type: text/plain; charset=\"UTF-8\"\r\n";
$body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$body .= $message . "\r\n";

$body .= "--{$separator}\r\n";
$body .= "Content-Type: image/png; name=\"bead_layout.png\"\r\n";
$body .= "Content-Transfer-Encoding: base64\r\n";
$body .= "Content-Disposition: attachment; filename=\"bead_layout.png\"\r\n\r\n";
$body .= chunk_split(base64_encode(file_get_contents($tmpFile))) . "\r\n";
$body .= "--{$separator}--";

// Send email
if (mail($to, $subject, $body, $headers)) {
    echo "Email sent successfully to {$to}!";
} else {
    echo "Failed to send email.";
}

// Delete temporary file
unlink($tmpFile);
?>

