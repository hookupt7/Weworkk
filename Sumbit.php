<?php
// ======== CONFIG (EDIT THESE!) ========
$YOUR_EMAIL = "olaonijoshua@gmail.com";  // Your Gmail
$COMPANY_NAME = "WeWork Procurement & Logistics";
$REDIRECT_URL = "success.html"; // Page after submission

// ======== PHP FORM HANDLER ========
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Get form data
    $fullName = htmlspecialchars($_POST['fullName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address = htmlspecialchars($_POST['address']);
    $product = htmlspecialchars($_POST['product']);

    // 2. Format email (HTML)
    $emailSubject = "📦 New Delivery: $product";
    $emailMessage = "
    <h2>WeWork Procurement - New Order</h2>
    <p><strong>Name:</strong> $fullName</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Address:</strong> $address</p>
    <p><strong>Product:</strong> $product</p>
    ";

    // 3. Send email via Gmail SMTP (better delivery)
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'olaonijoshua@gmail.com'; // Your Gmail
    $mail->Password = 'your-app-password';      // ⚠️ Use App Password (see Step 2)
    $mail->setFrom('noreply@weworkprocurements.com', $COMPANY_NAME);
    $mail->addAddress($YOUR_EMAIL);
    $mail->Subject = $emailSubject;
    $mail->Body = $emailMessage;
    $mail->isHTML(true);
    
    if ($mail->send()) {
        header("Location: $REDIRECT_URL"); // Redirect to success page
    } else {
        echo "Error: " . $mail->ErrorInfo; // Debug errors
    }
}
?>
