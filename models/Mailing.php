<?php
    
    namespace app\models;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require_once '../vendor/autoload.php';

    class Mailing {

        public function registration($fname, $lname, $email) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'd8a6e9b9a5fd9b'; 
            $mail->Password = '087e03c8669b5d'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
            $mail->setFrom('info@mailtrap.io', 'Mailtrap');
            $mail->addReplyTo('info@mailtrap.io', 'Mailtrap');
            $mail->addAddress($email, $fname . ' ' . $lname);
            $mail->Subject = 'GameXChange - Confirmation for registration';
            $mail->isHTML(true);

            $mailContent = "<div style='padding: 30px; box-sizing: border-box; margin-top:20px; backgound: #F2F2F2;'>
                                <p style='margin-left: 30px; color: #6B727C'>Hi $fname $lname,</p><br>
                                <p style='margin-left: 30px; color: #6B727C'>You have been successfully registered, you can now go back on GameXChange and log in.</p>
                                <p style='margin-left: 30px; color: #6B727C'>From GameXChange</p>
                            </div>";
            $mail->Body = $mailContent;
            $mail->CharSet="UTF-8";

            if($mail->send()){
                header("Location: /user/login?registration=success");
                exit();
            }else{
                header("Location: /user/signup?registration=failure");
                exit();
            }
        }

        public function contact($fnameSender, $lnameSender, $emailSender, $fnameReceiver, $lnameReceiver, $emailReceiver, $subject, $content, $id) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'd8a6e9b9a5fd9b'; 
            $mail->Password = '087e03c8669b5d'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
            $mail->setFrom($emailSender, $fnameSender . ' ' . $lnameSender);
            $mail->addReplyTo($emailSender, $fnameSender . ' ' . $lnameSender);
            $mail->addAddress($emailReceiver, $fnameReceiver . ' ' . $lnameReceiver);
            $mail->Subject = "Message from $fnameSender $lnameSender about $subject";
            $mail->isHTML(true);

            if (empty($subject) || empty($content)) {
                header("Location: /products/contact?id=$id&contact=emptyfields");
                exit();
            }

            $mailContent = "<div style='padding: 30px; box-sizing: border-box; margin-top:20px; backgound: #F2F2F2;'>
                                <p style='margin-left: 30px; color: #6B727C'>$subject</p><br>
                                <p style='margin-left: 30px; color: #6B727C'>$content</p>
                            </div>";
            $mail->Body = $mailContent;
            $mail->CharSet="UTF-8";

            if($mail->send()){
                header("Location: /products/contact?id=$id&contact=success");
                exit();
            }else{
                header("Location: /products/contact?id=$id&contact=failure");
                exit();
            }
        }

        public function buySeller($fnameSeller, $lnameSeller, $emailSeller, $usernameSeller, $usernameClient, $product) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'd8a6e9b9a5fd9b'; 
            $mail->Password = '087e03c8669b5d'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
            $mail->setFrom('info@mailtrap.io', 'Mailtrap');
            $mail->addReplyTo('info@mailtrap.io', 'Mailtrap');
            $mail->addAddress($emailSeller, $fnameSeller . ' ' . $lnameSeller);
            $mail->Subject = 'Darkbnb - Confirmation for your booking';
            $mail->isHTML(true);

            $title = $product['product_title'];
            $description = $product['product_description'];
            $price = $product['product_price'];
            $category = $product['category_name'];
            $region = $product['region_name'];

            $mailContent = "<div style='width: 100%; background: #F2F2F2; padding: 30px; box-sizing: border-box;'> 
                                <p style='color: #6B727C; margin-left: 30px;'>Dear $usernameSeller,</p> <br>
                                <p style='color: #6B727C; margin-left: 30px;'>One of your product has been bought by :</p><br>
                                <p style='color: #6B727C; margin-left: 30px;'>$usernameClient</p>
                                <table style='border: 1px solid #2F3948; border-collapse: collapse; width: 80%; margin: 20px auto; color:#2F3948'>
                                    <thead>
                                        <tr>
                                            <th scope='col' colspan='2' style='text-align: center;'>Purchase informations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product title</td>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$title</td>
                                        </tr>
                                        <tr>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product description</td>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$description</td>
                                        </tr>
                                        <tr>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product price</td>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$price</td>
                                        </tr>
                                        <tr>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product category</td>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$category</td>
                                        </tr>
                                        <tr>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Region</td>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$region</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>";
            $mail->Body = $mailContent;
            $mail->CharSet="UTF-8";

            $mail->send();
        }

        public function buyClient($fnameClient, $lnameClient, $emailClient, $usernameClient, $usernameSeller, $product) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'd8a6e9b9a5fd9b'; 
            $mail->Password = '087e03c8669b5d'; 
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;
            $mail->setFrom('info@mailtrap.io', 'Mailtrap');
            $mail->addReplyTo('info@mailtrap.io', 'Mailtrap');
            $mail->addAddress($emailClient, $fnameClient . ' ' . $lnameClient);
            $mail->Subject = 'Darkbnb - Confirmation for your booking';
            $mail->isHTML(true);

            $title = $product['product_title'];
            $description = $product['product_description'];
            $price = $product['product_price'];
            $category = $product['category_name'];
            $region = $product['region_name'];

            $mailContent = "<div style='width: 100%; background: #F2F2F2; padding: 30px; box-sizing: border-box;'> 
                                <p style='color: #6B727C; margin-left: 30px;'>Dear $usernameClient,</p> <br>
                                <p style='color: #6B727C; margin-left: 30px;'>You purchased a product from :</p><br>
                                <p style='color: #6B727C; margin-left: 30px;'>$usernameSeller</p>
                                <table style='border: 1px solid #2F3948; border-collapse: collapse; width: 80%; margin: 20px auto; color:#2F3948'>
                                    <thead>
                                        <tr>
                                            <th scope='col' colspan='2' style='text-align: center;'>Purchase informations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product title</td>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$title</td>
                                        </tr>
                                        <tr>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product description</td>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$description</td>
                                        </tr>
                                        <tr>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product price</td>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$price</td>
                                        </tr>
                                        <tr>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Product category</td>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$category</td>
                                        </tr>
                                        <tr>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>Region</td>
                                            <td style='text-align:left; padding: 16px; border: 1px solid #2F3948; color: #6B727C;'>$region</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>";


            $mail->Body = $mailContent;
            $mail->CharSet="UTF-8";

            $mail->send();
        }  
    }
