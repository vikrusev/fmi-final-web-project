<?php

require_once('server/session.php');

if (isset($_SESSION['user_name'])) {
    $username = $_SESSION['user_name'];
    echo "<span id='welcome'>Welcome" . (!isset($_SESSION['is_new']) ? " back, " : ", ") . "$username!</span>";
}

function authenticate($location_redirect, $auth_fields) {
    foreach ($auth_fields as $field) {
        if (!array_key_exists($field, $_SESSION)) {
            header("Location: $location_redirect");
            exit();
        }
    }
}

require('schemas/task_schema.php');

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

function build_special_checkbox($field_name, $class, $parent_name = '', $_ = false) {
    $is_from_main = $parent_name == 'main';
    $parent = $is_from_main ? $field_name : $parent_name . '-' . $field_name;

    echo "<div class='hidden " . ($is_from_main ? 'group' : 'sub-group') . "'>";
        echo build_HTML_Checkbox($field_name, false, $parent_name, true);

        foreach ($class as $property => $class_value) {
            echo (define_build_function($class_value))($property, $class_value, $parent);
        }
    echo '</div>';
}

function build_html_element($field, $class, $parent_name, $hide_html = false) {
    return ('build_' . get_class($class))($field, $class, $parent_name, $hide_html);
}

function build_HTML_Text($field_name, $class_data, $parent_name = '', $hide_html = false) {
    $parent = $parent_name ? "-$parent_name" : '';

    return "<div class='row" . ($hide_html ? ' hidden' : '') . "'>" 
                . build_label_for($field_name, $parent)
                . "<input type='text' id='$field_name$parent' name='$field_name$parent' value='" . $class_data->value . "'/>"
            . "</div>";
}

function build_HTML_Checkbox($field_name, $item_data = false, $parent_name = '', $hide_html = false) {
    $parent = $parent_name ? "-$parent_name" : '';
    $checked = is_object($item_data) ? $item_data->checked : false;

    // autocomplete='off' so that they are not checked automatically
    // if they have been checked and you go to them with history.back()
    // https://stackoverflow.com/a/55927735/13213781
    $input_field = $hide_html ?
        "<input onclick='showHide(this)' type='checkbox' autocomplete='off'
            id='$field_name$parent' name='$field_name$parent'" . ($checked ? 'checked' : '') . "/>"
        : "<input type='checkbox' autocomplete='off' id='$field_name$parent'
            name='$field_name$parent'" . ($checked ? 'checked' : '') . "/>";

    return "<div class='row'>"
                . $input_field
                . build_label_for($field_name, $parent)
            . "</div>";
}

function build_HTML_Select($field_name, $data, $parent_name = '', $hide_html = false) {
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

?>