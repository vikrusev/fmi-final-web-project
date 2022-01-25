<?php

require('html_classes.php');

class TaskConfiguration extends BaseTaskConfiguration {
    /**
     * The configuration's version number
     * 
     * ? Has default value
     */
    public $version;

    /**
     * Windows specific task configuration
     * 
     * * Optional
     */
    public $windows;

    /**
     * Linux specific task configuration
     * 
     * * Optional
     */
    public $linux;

    public function __construct()
    {
        parent::__construct();

        $this->version = new HTML_Text('1.0.0');
        $this->windows = new BaseTaskConfiguration();
        $this->linux = new BaseTaskConfiguration();
    }

}

class BaseTaskConfiguration {
    /**
     * The type of a custom task. Tasks of type "shell" are executed
     * inside a shell (e.g. bash, cmd, powershell, ...)
     * 
     * ! Must have
     */
    public $type; // 'shell' | 'process';

    /**
     * The command to be executed. Can be an external program or a shell
     * command.
     * 
     * ! Must have
     */
    public $command; // string;

    /**
     * Specifies whether a global command is a background task.
     * 
     * ? Has default value
     */
    public $isBackground;

    /**
     * The command options used when the command is executed. Can be omitted.
     * 
     * * Optional
     */
    public $options;

    /**
     * The arguments passed to the command. Can be omitted.
     * 
     * * Optional
     */
    public $args; // string[];

    /**
     * The presentation options.
     * 
     * * Optional
     */
    public $presentation;

    public function __construct()
    {
        $this->type = new HTML_Select(array(
            'shell',
            'process'
        ), 0);
        $this->command = new HTML_Text('', true);
        $this->isBackground = new HTML_Checkbox(false);
        $this->args = array(new HTML_Text(''));
        $this->options = new CommandOptions();
        $this->presentation = new PresentationOptions();
    }

    // public function addArg($value)
    // {
    //     array_push($this->args, new HTML_Text($value));
    // }
}

/**
 * Options to be passed to the external program or shell
 */
class CommandOptions {
    /**
     * The current working directory of the executed program or shell.
     * If omitted the current workspace's root is used.
     * 
     * ? Has default value
     */
    public $cwd;

    /**
     * The environment of the executed program or shell. If omitted
     * the parent process' environment is used.
     * 
     * * Optional
     */
    public $env; // { [key: string]: string };

    public function __construct()
    {
        $this->cwd = new HTML_Text('./');
        $this->env = array(new HTML_Text(''));
        // $this->env = new Checkbox(false);
    }
}

class PresentationOptions {
    /**
     * Controls whether the task output is reveal in the user class.
     * Defaults to `always`.
     * 
     * ? Has default value
     */
    public $reveal; // 'never' | 'silent' | 'always';

    /**
     * Controls whether the command associated with the task is echoed
     * in the user class. Defaults to `true`.
     * 
     * ? Has default value
     */
    public $echo; // boolean;

    /**
     * Controls whether the panel showing the task output is taking focus.
     * Defaults to `false`.
     * 
     * ? Has default value
     */
    public $focus; // boolean;

    /**
     * Controls if the task panel is used for this task only (dedicated),
     * shared between tasks (shared) or if a new panel is created on
     * every task execution (new). Defaults to `shared`.
     * 
     * ? Has default value
     */
    public $panel; // 'shared' | 'dedicated' | 'new';

    /**
     * Controls whether to show the `Terminal will be reused by tasks,
     * press any key to close it` message.
     * 
     * ? Has default value
     */
    public $showReuseMessage; // boolean;

    /**
     * Controls whether the terminal is cleared before this task is run.
     * Defaults to `false`.
     * 
     * ? Has default value
     */
    public $clear; // boolean;

    public function __construct()
    {
        $this->reveal = new HTML_Select(array(
            'always',
            'never',
            'silent'
        ), 0);
        $this->echo = new HTML_Checkbox(true);
        $this->focus = new HTML_Checkbox(false);
        $this->panel = new HTML_Select(array(
            'shared',
            'dedicated',
            'new'
        ), 0);
        $this->showReuseMessage = new HTML_Checkbox(true);
        $this->clear = new HTML_Checkbox(false);
    }
}

?>