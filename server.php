<?php

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
                if (is_string($json_array[$family][$class[2]])) {
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

// initiate logic for POST request
if ($_SERVER["REQUEST_METHOD"] == "POST"):
    $json_array = prepare_json_array($_POST);

    // encode the cleaned json_array to pure JSON
    $json = json_encode(json_array_cleanup($json_array));
?>

<!DOCTYPE html>

<html lang="bg">

<head>
    <title>WEB Final Project</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css" />

    <script>
        function copyToClipboard(json) {
            const data = JSON.stringify(json);

            navigator.clipboard.writeText(data);
            alert(`Copied the text: ${data}`);
        }
    </script>
</head>

<body>
    <div class="container">
        <div id="main">
            <?= $json; ?>

            <button onclick='copyToClipboard(<?= $json ?>)'>Copy to clipboard</button>
        </div>
    </div>
</body>

</html>

<?php endif; ?>