<?php

require('task_schema.php');

$config = new TaskConfiguration();
$config_vars = get_object_vars($config);

function define_build_function($class) {
    if (in_array(get_class($class), $GLOBALS['HTML_CLASSES'])) {
        return 'build_html_element';
    }

    return 'build_special_checkbox';
}

function build_label_for($name, $parent) {
    return "<label for='$name$parent'>$name</label>";
}

function build_special_checkbox($field_name, $class, $hide_html = false, $parent_name = '') {
    $is_from_main = $parent_name == 'main';
    $parent = $is_from_main ? $field_name : $parent_name;

    echo "<div class='hidden " . ($is_from_main ? 'group' : 'sub-group') . "'>";
        echo build_HTML_Checkbox($field_name, false, false, $parent_name);

        foreach ($class as $property => $class_value) {
            echo (define_build_function($class_value))($property, $class_value, false, $parent);
        }
    echo '</div>';
}

function build_html_element($field, $class, $hide_html = false, $parent_name) {
    return ('build_' . get_class($class))($field, $class, $hide_html, $parent_name);
}

function build_HTML_Text($field_name, $class_data, $hide_html = false, $parent_name = '') {
    $parent = $parent_name ? "-$parent_name" : '';
    return "<div class='row" . ($hide_html ? ' hidden' : '') . "'>" 
                . build_label_for($field_name, $parent)
                . "<input type='text' id='$field_name$parent' name='$field_name$parent' placeholder='" . $class_data->value . "'/>"
            . "</div>";
}

function build_HTML_Checkbox($field_name, $item_data = false, $hide_html = false, $parent_name = '') {
    $parent = $parent_name ? "-$parent_name" : '';
    $checked = is_object($item_data) ? $item_data->checked : false;

    return "<div class='row" . ($hide_html ? ' hidden' : '') . "'>" 
                . "<input type='checkbox' id='$field_name$parent' name='$field_name$parent'" . ($checked ? 'checked' : '') . "/>"
                . build_label_for($field_name, $parent)
            . "</div>";
}

function build_HTML_Select($field_name, $data, $hide_html = false, $parent_name = '') {
    $selection = '';

    foreach($data->options as $key => $value) {
        $selection .= "<option value='$value' " . ($key == $data->selected_index ? 'selected' : '') . ">$value</option>";
    }

    $parent = $parent_name ? "-$parent_name" : '';
    return "<div class='row" . ($hide_html ? ' hidden' : '') . "'>" 
                . build_label_for($field_name, $parent)
                . "<select name='$field_name$parent' id='$field_name$parent'>"
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