<?php

require('task_schema.php');

$config = new TaskConfiguration();
$config_vars = get_object_vars($config);

function define_build_function($class) {
    if (is_array($class)) {
        return 'build_array_html_field';
    }

    if (in_array(get_class($class), $GLOBALS['HTML_CLASSES'])) {
        return 'build_html_element';
    }

    return 'build_special_checkbox';
}

function build_label_for($name) {
    return "<label for='$name'>$name</label>";
}

function build_array_html_field($field_name, $class, $hide_html = false) {
    foreach ($class as $value) {
        echo (define_build_function($value))($field_name, $value, $hide_html);
    }
}

function build_special_checkbox($field_name, $class, $hide_html = false) {
    echo build_HTML_Checkbox($field_name, '', $hide_html);

    foreach ($class as $property => $class_value) {
        if (is_array($class_value)) {
            build_array_html_field($property, $class_value, false);
        }
        else {
            echo (define_build_function($class_value))($property, $class_value, false);
        }
    }
}

function build_html_element($field, $class, $hide_html = false) {
    return ('build_' . get_class($class))($field, $class, $hide_html);
}

function build_HTML_Text($field_name, $class_data, $hide_html = false) {
    return "<div class='" . ($hide_html ? 'hidden' : '') . "'>" 
                . build_label_for($field_name)
                . "<input type='text' id='$field_name' name='$field_name' placeholder='" . $class_data->value . "'/>"
            . "</div>";
}

function build_HTML_Checkbox($field_name, $_ = '', $hide_html = false) {
    return "<div class='" . ($hide_html ? 'hidden' : '') . "'>" 
                . "<input type='checkbox' id='$field_name' name='$field_name' />"
                . build_label_for($field_name)
            . "</div>";
}

function build_HTML_Select($field_name, $data, $hide_html = false) {
    $selection = '';

    foreach($data->options as $key => $value) {
        $selection .= "<option value='$value' " . ($key == $data->selected_index ? 'selected' : '') . ">$value</option>";
    }

    return "<div class='" . ($hide_html ? 'hidden' : '') . "'>" 
                . build_label_for($field_name)
                . "<select name='$field_name' id='$field_name'>"
                    . $selection
                . "</select>"
            . "</div>";
}

// foreach ($fields as $name => $value) {
//     var_dump($value);
// }
// initiate logic for POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // prepare the validator
    // $validator = new Validator($validate_form_inputs, 
    //                             $validate_form_rules, 
    //                             $validate_form_rules_error_messages, 
    //                             $validate_form_rules_display_messages);

    // // validate the form data
    // $validator->validate($_POST);

    echo $config->version;
}

?>