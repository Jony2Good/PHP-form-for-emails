<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/valid/functions.php';
require_once __DIR__ . '/valid/data.php';

if (!empty($_POST)) {
    $fields = load($fields);
    if ($errors = validate($fields)) {
        $res = ['answer' => 'error', 'errors' => $errors];

    } else {
        if (!send_mail($fields, $mail_settings)) {
            $res = ['answer' => 'error', 'errors' => 'Ошибка отправки письма'];
        } else {
            $res = ['answer' => 'ok', 'captcha' => set_captcha()];
        }
    }
exit(json_encode($res));
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP form testing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<h1 class="text-center">Hello, PHP!</h1>
<div class="container">
    <div class="row justify-content-center">
        <form method="post" class="needs-validation form-layout" id="form" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="name" required>
                <div class="invalid-feedback">
                    Please enter your name.
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="example@gmail.com" required>
                <div class="invalid-feedback">
                    Please enter email address.
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address" placeholder="address">
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="phone" required>
                <div class="invalid-feedback">
                    Please enter your phone number
                </div>
            </div>
            <div class="mb-3">
                <label for="comments" class="form-label">Comments</label>
                <textarea name="comments" class="form-control" id="comments" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="captcha" id="label-captcha" class="form-label"><?= set_captcha() ?></label>
                <input type="text" name="captcha" class="form-control" id="captcha" placeholder="captcha" required>
                <div class="invalid-feedback">
                    Please enter sum of numbers.
                </div>
            </div>
            <div class="form-group form-check mb-3">
                <input class="form-check-input" name="agree" type="checkbox" value="" id="agree" required>
                <label class="form-check-label" for="agree">
                    Default checkbox
                </label>
                <div class="invalid-feedback">
                    Please agree with checkbox.
                </div>
            </div>
            <button class="btn btn-primary" type="submit">SUBMIT</button>
            <div class="mt-3" id="answer"></div>

            <div class="spinner-layout spinner-active" id="spinner">
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="main.js"></script>
</body>
</html>