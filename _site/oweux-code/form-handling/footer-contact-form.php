<?php

date_default_timezone_set('America/New_York');

$form_name = basename(__FILE__, '.php');

$form_json_log_file = '../form-logging/' . $form_name . ".json";

if (!file_exists($form_json_log_file)) {

    $form_json_log_array = array();

} else {

    $form_json_log_array = json_decode(file_get_contents($form_json_log_file), true);

    if (!is_array($form_json_log_array)) {

        $form_json_log_array = array();

    }


}

//echo "<pre>" . print_r($_POST, true) . "</pre>";

$form_submission_unique = date('Y-m-d H-i-s') . mt_rand(10000, 99999);

if (isset($_POST) && !empty($_POST)) {

    $form_json_log_array[$form_submission_unique] = $_POST;

    $recipient_array = array(


        "contact@speedy-sites.com" => "Riley Goodman",
        "fernando@oweux.com" => "Fernando Venturello",
        //"info@securepayservice.com" => "info@securepayservice.com",

    );


    $text_content = 'Please use an HTML capable client to read this email';

    $html_content = array();

    foreach ($_POST as $_POST_label => $_POST_value) {

        $html_content[] = "<p><strong>" . str_replace(array('-', '_'), ' ', $_POST_label) . "</strong>: {$_POST_value}</p>";

    }

    $html_content = print_r(implode('', $html_content), true);

    require('../sendgrid/code/send-script.php');


} else {

    $form_json_log_array[$form_submission_unique] = array(

        'success' => 'false',
        'message' => 'nothing posted',

    );

}

//echo "<pre>" . print_r($form_json_log_array, true) . "</pre>";

file_put_contents($form_json_log_file, json_encode($form_json_log_array));


require("../form-output/{$form_name}-thank-you-block.php");
