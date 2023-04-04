<?php

function debug($data): void
{
    print_r($data, return: 1);
}

function load($data): array
{
    foreach ($_POST as $key => $value) {
        if (array_key_exists($key, $data)) {
            $data[$key]['value'] = trim($value);
        }
    }
    return $data;
}

function validate($data): string
{
    $errors = '';
    foreach ($data as $k => $v) {
        if ($data[$k]['required'] && empty($data[$k]['value'])) {
            $errors .= "<div>The field {$data[$k]['field_name']} is empty</div>";
        }

    }
    if (!check_capture($data['captcha']['value'])) {
        $errors .= "<div>Wrong captcha field</div>";
    }
    return $errors;
}

function set_captcha(): string
{
    $num1 = rand(1, 5);
    $num2 = rand(1, 5);
    $_SESSION['captcha'] = $num1 + $num2;
    return "What is score {$num1} + {$num2}?";
}

function check_capture($res): bool
{
    return $_SESSION['captcha'] == $res;
}

function send_mail($fields, $mail_settings): bool
{
    $mail = new \PHPMailer\PHPMailer\PHPMailer();
    try {
        $mail->SMTPDebug = 1;
        $mail->isSMTP();
        $mail->Host = $mail_settings['host'];
        $mail->SMTPAuth = $mail_settings['smtp_auth'];
        $mail->Username = $mail_settings['username'];
        $mail->Password = $mail_settings['password'];
        $mail->SMTPSecure = $mail_settings['smtp_secure'];
        $mail->Port = $mail_settings['port'];

        //Recipients
        $mail->setFrom($mail_settings['from_email'], $mail_settings['from_name']);
        $mail->addAddress($mail_settings['to_email']);

        //Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'App form';


        $flag = true;
        $message = '';
        foreach ($fields as $k => $v) {
            if (isset($v['mailable']) && $v['mailable'] == 0) {
                continue;
            }
            $message .= (($flag = !$flag) ? '<tr>' : '<tr style="background-color:#f8f8f8;">') . "
            <td style='padding: 10px: border: #e9e9e9 1px solid;'> <b>{$v['field_name']}</b></td> <td style='padding: 10px: border: #e9e9e9 1px solid;'> {$v['value']}</td>
         </tr>";
        }

        $mail->Body = "<table style='width: 100%;'>$message</table>";
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
