<?php
class Mail extends CI_Model{
    
    function send($to,$msg,$subject='Message'){
        // $sender_name = $this->other->getVal('mail_sender_name','Webfire');
        // $sender_email = $this->other->getVal('mail_sender_email','');
        // Message content
        $message = '<!doctype html>
                        <html lang="en">
                          <head>
                            <meta charset="utf-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1">
                            <title>Contact Messages</title>
                          </head>
                          <body>
                            '.$msg.'
                          </body>
                        </html>';
        
        // Additional headers
        $headers = '';
        // $headers = "From: $sender_name <$sender_email>" . "\r\n";
        // $headers .= "Reply-To: replyto@example.com" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        
        // Send the email
        $mailSent = mail($to, $subject, $message, $headers);
        
        // Check if the email was sent successfully
        return $mailSent;
    }
    
}