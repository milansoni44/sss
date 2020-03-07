<?php

/**

 * Created by PhpStorm.

 * User: rakeshj

 * Date: 9/9/2019

 * Time: 4:51 PM

 */



use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;



class Mymailer

{

    private $CI = null;

    private $settings = null;



    public function __construct()

    {

        $this->CI =& get_instance();

        $this->settings = [
            'email_host'    =>  'smtp.gmail.com',
            'username'      =>  'rakeshjangir.ehs@gmail.com',
            'password'      =>  'abc@123_4',
            'system_name'   =>  'XYZ Company',
            'reply_to'      =>  'rakeshjangir.ehs@gmail.com',
            'reply_to_name' =>  'Rakesh Jangir',
        ];

    }



    public function send_email($subject,$body,$to,$cc=null,$bcc=null,$attachments_str_arr=NULL){



        $phpmailer = new PHPMailer(true);



        try {



            //ssl on 465 or tls on 587



            //Server settings

//            $phpmailer->SMTPDebug = 3;                                 // Enable verbose debug output

            $phpmailer->isSMTP();                                      // Set mailer to use SMTP

            $phpmailer->Host = $this->settings['email_host'];//'smtp.gmail.com';            // Specify main and backup SMTP servers

            $phpmailer->SMTPAuth = true;                               // Enable SMTP authentication

            $phpmailer->Username = $this->settings['username'];            // SMTP username

            $phpmailer->Password = $this->settings['password'];             // SMTP password

            $phpmailer->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted

            $phpmailer->Port = 587;                                    // TCP port to connect to



            //Recipients

            $phpmailer->setFrom($this->settings['username'], $this->settings['system_name']);





            if(is_array($to)){

                foreach($to as $c){

                    $phpmailer->addAddress($c);

                }

            }elseif(is_string($to)){

                $phpmailer->addAddress($to);

            }



            //$phpmailer->addAddress($to);

            $phpmailer->addReplyTo($this->settings['reply_to'], $this->settings['reply_to_name']);



            //$phpmailer->addCC('cc@example.com');

            if($cc){

                if(is_array($cc)){

                    foreach($cc as $c){

                        $phpmailer->addCC($c);

                    }

                }elseif(is_string($cc)){

                    $phpmailer->addCC($cc);

                }

            }





            //$phpmailer->addBCC('bcc@example.com');

            if($bcc){

                if(is_array($bcc)){

                    foreach($bcc as $bc){

                        $phpmailer->addBCC($bc);

                    }

                }elseif(is_string($bcc)){

                    $phpmailer->addBCC($bcc);

                }

            }



            //Attachments

            //$phpmailer->addAttachment('/var/tmp/file.tar.gz');         // Add attachments

            //$phpmailer->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name



            if($attachments_str_arr){

                if(is_array($attachments_str_arr)){

                    foreach($attachments_str_arr as $attachment_path){

                        $phpmailer->addAttachment($attachment_path);

                    }

                }else if(is_string($attachments_str_arr)){

                    if(file_exists($attachments_str_arr)){

                        $phpmailer->addAttachment($attachments_str_arr);

                    }

                }

            }



            //Content

            $phpmailer->isHTML(true);                                  // Set email format to HTML

            $phpmailer->Subject = $subject;

            $phpmailer->Body    = $body;

            //$phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';



            $phpmailer->send();



            return array(

                'status'    =>  true,

                'message'   =>  "Email Sent"

            );



        } catch (phpmailerException $e) {

            return array(

                'status'    =>  false,

                'message'   =>  "PHPMailer Exception : ".$phpmailer->ErrorInfo

            );

        }catch(Exception $e){

            return array(

                'status'    =>  false,

                'message'   =>  "Exception : ".$e->errorMessage()

            );

        }

    }

}