<?php

$form_json_log_file =  '../form-logging/' . basename(__DIR__, '.php') . ".json";

if (!file_exists($form_json_log_file)) {

    $form_json_log_array = array();

} else {

    $form_json_log_array = json_decode(file_get_contents($form_json_log_file), true);

    if(!is_array($form_json_log_array)){

        $form_json_log_array = array();

    }


}

$form_json_log_array[] = $_POST;

if (isset($POST) && !empty($POST)) {

    file_put_contents($form_json_log_file, json_encode($POST));

} else {

    file_put_contents($form_json_log_file, json_encode(array(

        'success' => 'false',
        'message' => 'nothing posted',

    )), FILE_APPEND);

}

