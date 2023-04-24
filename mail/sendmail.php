<?php
include "PHPMailer/src/PHPMailer.php";
include "PHPMailer/src/Exception.php";
include "PHPMailer/src/OAuth.php";
include "PHPMailer/src/POP3.php";
include "PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function dathangmail($tieude, $noidung, $maildathang)
    {

        $mail = new PHPMailer(true);
        $mail->CharSet = 'UTF-8';

        //print_r($mail);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output, bật tính năng gửi thành công hoặc ko vẫn show tt của mail để dễ cấu hình, ko muốn show thì đẻ =0
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers, sử dụng nhiều cái server, ở đây sd 1 cái smtp
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'thamc1502@gmail.com';                 // SMTP username, thực hiện việc gửi mail
            $mail->Password = 'jjgxtskvzvhhjjsn';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted, cổng tls
            $mail->Port = 587;                                    // TCP port to connect to "tls: 587, ssl: 465"

            //Recipients
            $mail->setFrom('thamc1502@gmail.com', 'Mailer');
            //Gửi cho nhiều người
            $mail->addAddress($maildathang, 'Thắm Thắm');     // Add a recipient
            //$mail->addAddress('daob1809115@student.ctu.edu.vn', 'Hồng Đào');               // Name is optional
            $mail->addCC('thamc1502@gmail.com');
            //$mail->addReplyTo('info@example.com', 'Information');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $tieude;
            $mail->Body    = $noidung;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo 'Đã gửi mail xong';
        } catch (Exception $e) {
            echo 'Mail không thể gửi đi. Lỗi: ', $mail->ErrorInfo; //mail gửi ko thành công
        }
    }
}
