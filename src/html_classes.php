<?php

function is_html_class($class) {
    return strpos($class, 'HTML_') === 0;
}

$GLOBALS['HTML_CLASSES'] = array_filter(get_declared_classes(), 'is_html_class');

class HTML_Field {
    public $required;

    public function __construct($required = false) {
        $this->required = $required;
    }
}

class HTML_Text extends HTML_Field {
    public $value;

    public function __construct($value = '', $required = false) {
        $this->value = $value;
        parent::__construct($required);
    }
}

class HTML_Checkbox extends HTML_Field {
    public $checked;

    public function __construct($checked, $required = false) {
        parent::__construct($required);
        $this->checked = $checked;
    }
}

class HTML_Select extends HTML_Field {
    public $options;
    public $selected_index;

    public function __construct($options, $selected_index = 0, $required = false) {
        parent::__construct($required);
        $this->options = $options;
        $this->selected_index = $selected_index;
    }
}

?>