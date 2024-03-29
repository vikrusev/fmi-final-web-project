<?php

require_once('session.php');
require_once('../db/requires.php');

function prepare_json_array($post_data) {
    $json_array = array();

    // fill up json_array w/ data from request
    foreach ($post_data as $key => $value) {
        // checkboxes should be true / false
        // not "on" or "off"
        // actually "off" checkboxes are not sent to server
        // https://stackoverflow.com/a/12115414/13213781
        // however, if input value is "on"... we have a problem :)
        if ($value == "on") {
            $value = true;
        }

        $class = explode('-', $key);
        $property = $class[0];
        $family = $class[1];

        if (isset($class[2])) {
            if (isset($json_array[$family][$class[2]])) {
                if (is_bool($json_array[$family][$class[2]])) {
                    unset($json_array[$family][$class[2]]);
                }

                $json_array[$family][$class[2]][$property] = $value;
            }

            continue;
        }

        $json_array[$family][$property] = $value;
    }

    return $json_array;
}

function json_array_cleanup($json_array) { 
     // remove whatever is not checked from main
     foreach ($json_array as $key => $_) {
        if ($key != 'main' && !isset($json_array['main'][$key])) {
            unset($json_array[$key]);
        }

        // clean the main object from "on" checkboxes
        if ($key != 'main' && isset($json_array['main'][$key])) {
            unset($json_array['main'][$key]);
        }
    }

    $temp_array = array();
    // "main" object should go one level out
    foreach ($json_array['main'] as $key => $value) {
        $temp_array[$key] = $value;
    }

    $json_array = array_merge($temp_array, $json_array);
    $temp_array = []; // free memory

    // remove main
    unset($json_array['main']);

    return $json_array;
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../');
    exit();
}

// initiate logic for POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json_array = prepare_json_array($_POST);
    $clean_json = json_array_cleanup($json_array);

    if (isset($_POST['history_id'])) {
        $history_id = updateHistory($conn, json_encode($clean_json), $_POST['history_id']);
    }
    else {
        $history_id = insertHistory($conn, json_encode($clean_json));
    }

    if ($history_id != -1) {
        $_SESSION['generated_json'] = array();

        // encode the cleaned json_array to pure JSON
        $_SESSION['generated_json'][$history_id] = json_encode($clean_json, JSON_PRETTY_PRINT);

        header('Location: ../pages/present.php');
        exit();
    }
}

header('Location: ../');
exit();

?>