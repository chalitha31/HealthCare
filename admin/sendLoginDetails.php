<?php

require "../connection.php";
require "../php_mail/SMTP.php";
require "../php_mail/Exception.php";
require "../php_mail/PHPMailer.php";

use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $formData = json_decode(file_get_contents("php://input"));

if (!isset($formData->nic)) {

    echo "Please enter your nic or passport number!";
}else if (empty($formData->nic)) {
    echo "Please enter your nic or passport number!";
} else if (empty($formData->email)) {
    echo "Please enter your Email address.";
} else {


    $nic = $formData->nic;
    $email = $formData->email;
    $source = $formData->source;

    $pwHash = substr(uniqid(), 0, 8);   

    $code = hash("sha256", "$pwHash");
            
    // Process data based on the source
    switch ($source) {
        case 'doctor':
            Database::iud("INSERT INTO `registered_doctor` (`id_num`,`email`,`password`) VALUES ('" . $nic . "','" . $email . "','" . $code . "')");
            break;
        case 'receptionist':
            Database::iud("INSERT INTO `registered_reception` (`id_num`,`email`,`password`) VALUES ('" . $nic . "','" . $email . "','" . $code . "')");
            break;
        case 'mlt':
            Database::iud("INSERT INTO `registered_mlt` (`id_num`,`email`,`password`) VALUES ('" . $nic . "','" . $email . "','" . $code . "')");
            break;
        case 'pharmacist':
            Database::iud("INSERT INTO `registered_pharmacists` (`id_num`,`email`,`password`) VALUES ('" . $nic . "','" . $email . "','" . $code . "')");
            break;
        default:
            $subject = "Unknown Source";
            $message = "Data received from an unknown source: ";
            break;
    }
          
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'chamodnadeeshan91@gmail.com';
            $mail->Password = 'rkrypofcifmrzhjo';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('chamodnadeeshan91@gmail.com', 'HelathCare');
            $mail->addReplyTo('chamodnadeeshan91@gmail.com', 'HelathCare');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to Healthcare : Your Login Details and Next Steps.';
            // $bodyContent = ' <h3 style = "color : green;">Your Verification code is :' . $code . '</h1> ';
            // $mail->Body = $bodyContent;

            $mail->Body    = "
            Dear {$source},<br><br>
            We are pleased to welcome you to Healthcare. Your account has been successfully created, and you can now access our Healthcare Admin Panel. Below are your login credentials:<br><br>
            <strong>Login URL:</strong> <a href='http://localhost/HealthCare/index.php'>Healthcare</a><br>
            <strong>Email : </strong> {$email}<br>
            <strong>Temporary Password : </strong> {$pwHash}<br><br>
            For security reasons, we recommend that you log in to your account immediately and update your password and profile information.<br><br>
            <strong>How to Log In:</strong><br>
            <ol>
                <li>Visit the <a href='http://localhost/HealthCare/index.php'>Healthcare Home Page</a>.</li>
                <li>Click the login button at the top right corner.</li>
                <li>Enter your email address and the temporary password provided above.</li>
                <li>You will be prompted to update your password upon your first login. Please choose a strong and unique password.</li>
            </ol>
            <strong>Updating Your Profile:</strong><br>
            <ol>
                <li>After logging in, Click the pencil button at the top right corner of the profile page.</li>
                <li>Update your personal and professional information, including your contact details, specialty, and other relevant data.</li>
                <li>Save your changes to ensure your profile is up-to-date.</li>
            </ol>
            If you encounter any issues or have any questions, please do not hesitate to contact our support team at helthcare.info@gmail.com or call us at 0115468956.<br><br>
            We are committed to providing you with the best tools and support to help you manage your practice efficiently. Thank you for being a part of our healthcare community.<br><br>
            Best regards,<br>
            Administrator<br>
            HealthCare<br><br>
            ---
            <br>
            <strong>Note:</strong> This email is confidential and intended solely for the use of the individual to whom it is addressed. If you have received this email in error, please notify the sender immediately and delete it from your system.
        ";

        $mail->AltBody = "Dear Doctor,\n\n".
            "We are pleased to welcome you to Healthcare. Your account has been successfully created, and you can now access our Healthcare Admin Panel. Below are your login credentials:\n\n".
            "Login URL: http://localhost/HealthCare/index.php\n".
            "Email: {$email}\n".
            "Temporary Password: {$pwHash}\n\n".
            "For security reasons, we recommend that you log in to your account immediately and update your password and profile information.\n\n".
            "How to Log In:\n".
            "1. Visit the http://localhost/HealthCare/index.php.\n".
            "2. Click the login button at the top right corner.\n".
            "3. Enter your email address and the temporary password provided above.\n".
            "4. You will be prompted to update your password upon your first login. Please choose a strong and unique password.\n\n".
            "Updating Your Profile:\n".
            "1. After logging in, Click the pencil button at the top right corner of the profile page.\n".
            "2. Update your personal and professional information, including your contact details, specialty, and other relevant data.\n".
            "3. Save your changes to ensure your profile is up-to-date.\n\n".
            "If you encounter any issues or have any questions, please do not hesitate to contact our support team at helthcare.info@gmail.com or call us at 0115468956.\n\n".
            "We are committed to providing you with the best tools and support to help you manage your practice efficiently. Thank you for being a part of our healthcare community.\n\n".
            "Best regards,\n".
            "Administrator\n".
            "HealthCare\n\n".
            "---\n".
            "Note: This email is confidential and intended solely for the use of the individual to whom it is addressed. If you have received this email in error, please notify the sender immediately and delete it from your system.";


            if (!$mail->send()) {
              
                echo 'Verification code sending failed';
            } else {
                echo 'success';
            }
       
    
}

} else {
    echo "Invalid request method.";
}