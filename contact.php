<?php
include "dbcon.php";

// Initialize variables
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validation
    if (empty($name) || empty($email) || empty($message)) {
        $error = "Name, Email, and Message are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } else {
        // Insert into database
        $stmt = mysqli_prepare($conn, "INSERT INTO contacts (name,email,phone,subject,message,created_at) VALUES (?,?,?,?,?,NOW())");
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $phone, $subject, $message);

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            // Redirect to clear POST and show success message
            header("Location: contact.php?success=1");
            exit;
        } else {
            $error = "Failed to send message. Please try again later.";
        }
    }
}

// Check if redirected after successful submission
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success = "Thank you! Your message has been sent successfully.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Us | Ekta Pyramid Spiritual Trust</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
.hero{
    background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
    url('assets/images/contact.jpg') center/cover;
    color:#fff;
    padding:120px 0;
}
</style>
</head>
<body>

<?php include "includes/header.php"; ?>

<!-- HERO -->
<section class="hero text-center">
<div class="container">
    <h1 class="fw-bold">Contact Us</h1>
    <p class="mt-2">Reach out for meditation guidance or any queries</p>
</div>
</section>

<!-- CONTACT FORM -->
<section class="py-5">
<div class="container">
<div class="row justify-content-center">
    <div class="col-lg-6">

        <?php if($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php if($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <div class="card shadow-sm p-4">
            <form method="post" action="">

                <div class="mb-3">
                    <label class="form-label">Name *</label>
                    <input type="text" name="name" class="form-control" required value="">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"  value="">
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone *</label>
                    <input type="tel"
                            name="phone"
                            class="form-control"
                            required
                            pattern="[0-9]{10}"
                            maxlength="10"
                            placeholder="Enter 10 digit mobile number"
                            title="Please enter a valid 10 digit phone number" />
                </div>

                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control" value="">
                </div>

                <div class="mb-3">
                    <label class="form-label">Message *</label>
                    <textarea name="message" class="form-control" rows="5" required></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100">Send Message</button>

            </form>
        </div>

    </div>
</div>
</div>
</section>

<?php include "includes/footer.php"; ?>

</body>
</html>
