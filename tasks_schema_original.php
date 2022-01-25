<?php

class TaskConfiguration extends BaseTaskConfiguration {
  /**
   * The configuration's version number
   */
  public $public; // version = '2.0.0';

  /**
   * Windows specific task configuration
   */
  public $windows = new BaseTaskConfiguration();

  // SKIPPING
  /**
   * macOS specific task configuration
   */
  // public $osx = new BaseTaskConfiguration();

  /**
   * Linux specific task configuration
   */
  public $linux = new BaseTaskConfiguration();
}

class BaseTaskConfiguration {
  /**
   * The type of a custom task. Tasks of type "shell" are executed
   * inside a shell (e.g. bash, cmd, powershell, ...)
   */
  public $type; // 'shell' | 'process';

  /**
   * The command to be executed. Can be an external program or a shell
   * command.
   */
  public $command; // string;

  /**
   * Specifies whether a global command is a background task.
   */
  public $isBackground; // boolean;

  /**
   * The command options used when the command is executed. Can be omitted.
   */
  public $options = new CommandOptions();

  /**
   * The arguments passed to the command. Can be omitted.
   */
  public $args; // string[];

  /**
   * The presentation options.
   */
  public $presentation = new PresentationOptions();

    // SKIPPING
  /**
   * The problem matcher to be used if a global command is executed (e.g. no tasks
   * are defined). A tasks.json file can either contain a global problemMatcher
   * property or a tasks property but not both.
   */
//   public $problemMatcher; // string | ProblemMatcher | (string | ProblemMatcher)[];

    // SKIPPING
  /**
   * The configuration of the available tasks. A tasks.json file can either
   * contain a global problemMatcher property or a tasks property but not both.
   */
//   public $tasks; // TaskDescription[];
}

/**
 * Options to be passed to the external program or shell
 */
class CommandOptions {
  /**
   * The current working directory of the executed program or shell.
   * If omitted the current workspace's root is used.
   */
  public $cwd; // string;

  /**
   * The environment of the executed program or shell. If omitted
   * the parent process' environment is used.
   */
  public $env; // { [key: string]: string };

    // SKIPPING
  /**
   * Configuration of the shell when task type is `shell`
   */
//   public $shell = {
//     /**
//      * The shell to use.
//      */
//     executable: string;

//     /**
//      * The arguments to be passed to the shell executable to run in command mode
//      * (e.g ['-c'] for bash or ['/S', '/C'] for cmd.exe).
//      */
//     args?: string[];
//   }
}

// SKIPPING
/**
 * The description of a task.
 */
// class TaskDescription {
//   /**
//    * The task's name
//    */
//   public $label; // string;

//   /**
//    * The type of a custom task. Tasks of type "shell" are executed
//    * inside a shell (e.g. bash, cmd, powershell, ...)
//    */
//   public $type; // 'shell' | 'process';

//   /**
//    * The command to execute. If the type is "shell" it should be the full
//    * command line including any additional arguments passed to the command.
//    */
//   public $command; // string;

//   /**
//    * Whether the executed command is kept alive and runs in the background.
//    */
//   public $isBackground; // boolean;

//   /**
//    * Additional arguments passed to the command. Should be used if type
//    * is "process".
//    */
//   public $args; // string[];

//   /**
//    * Defines the group to which this task belongs. Also supports to mark
//    * a task as the default task in a group.
//    */
//   public $group; // 'build' | 'test' | { kind: 'build' | 'test'; isDefault: boolean };

//   /**
//    * The presentation options.
//    */
//   public $presentation; // PresentationOptions;

//   /**
//    * The problem matcher(s) to use to capture problems in the tasks
//    * output.
//    */
//   public $problemMatcher; // string | ProblemMatcher | (string | ProblemMatcher)[];

//   /**
//    * Defines when and how a task is run.
//    */
//   public $runOptions; // RunOptions;
// }

class PresentationOptions {
  /**
   * Controls whether the task output is reveal in the user class.
   * Defaults to `always`.
   */
  public $reveal; // 'never' | 'silent' | 'always';

  /**
   * Controls whether the command associated with the task is echoed
   * in the user class. Defaults to `true`.
   */
  public $echo; // boolean;

  /**
   * Controls whether the panel showing the task output is taking focus.
   * Defaults to `false`.
   */
  public $focus; // boolean;

  /**
   * Controls if the task panel is used for this task only (dedicated),
   * shared between tasks (shared) or if a new panel is created on
   * every task execution (new). Defaults to `shared`.
   */
  public $panel; // 'shared' | 'dedicated' | 'new';

  /**
   * Controls whether to show the `Terminal will be reused by tasks,
   * press any key to close it` message.
   */
  public $showReuseMessage; // boolean;

  /**
   * Controls whether the terminal is cleared before this task is run.
   * Defaults to `false`.
   */
  public $clear; // boolean;

  // SKIPPING
  /**
   * Controls whether the task is executed in a specific terminal
   * group using split panes. Tasks in the same group (specified by a string value)
   * will use split terminals to present instead of a new terminal panel.
   */
  // public $group; // string;
}

// SKIPPING
/**
 * A description of a problem matcher that detects problems
 * in build output.
 */
// class ProblemMatcher {
//   /**
//    * The name of a base problem matcher to use. If specified the
//    * base problem matcher will be used as a template and properties
//    * specified here will replace properties of the base problem
//    * matcher
//    */
//   public $base; // string;

//   /**
//    * The owner of the produced VS Code problem. This is typically
//    * the identifier of a VS Code language service if the problems are
//    * to be merged with the one produced by the language service
//    * or 'external'. Defaults to 'external' if omitted.
//    */
//   public $owner; // string;

//   /**
//    * The severity of the VS Code problem produced by this problem matcher.
//    *
//    * Valid values are:
//    *   "error": to produce errors.
//    *   "warning": to produce warnings.
//    *   "info": to produce infos.
//    *
//    * The value is used if a pattern doesn't specify a severity match group.
//    * Defaults to "error" if omitted.
//    */
//   public $severity; // string;

//   /**
//    * Defines how filename reported in a problem pattern
//    * should be read. Valid values are:
//    *  - "absolute": the filename is always treated absolute.
//    *  - "relative": the filename is always treated relative to
//    *    the current working directory. This is the default.
//    *  - ["relative", "path value"]: the filename is always
//    *    treated relative to the given path value.
//    *  - "autodetect": the filename is treated relative to
//    *    the current workspace directory, and if the file
//    *    does not exist, it is treated as absolute.
//    *  - ["autodetect", "path value"]: the filename is treated
//    *    relative to the given path value, and if it does not
//    *    exist, it is treated as absolute.
//    */
//   public $fileLocation; // string | string[];

//   /**
//    * The name of a predefined problem pattern, the inline definition
//    * of a problem pattern or an array of problem patterns to match
//    * problems spread over multiple lines.
//    */
//   public $pattern; // string | ProblemPattern | ProblemPattern[];

//   /**
//    * Additional information used to detect when a background task (like a watching task in Gulp)
//    * is active.
//    */
//   public $background; // BackgroundMatcher;
// }

// SKIPPING
/**
 * A description to track the start and end of a background task.
 */
// class BackgroundMatcher {
//   /**
//    * If set to true the watcher is in active mode when the task
//    * starts. This is equals of issuing a line that matches the
//    * beginPattern.
//    */
//   public $activeOnStart; // boolean;

//   /**
//    * If matched in the output the start of a background task is signaled.
//    */
//   public $beginsPattern; // string;

//   /**
//    * If matched in the output the end of a background task is signaled.
//    */
//   public $endsPattern; // string;
// }

// SKIPPING
// class ProblemPattern {
//   /**
//    * The regular expression to find a problem in the console output of an
//    * executed task.
//    */
//   public $regexp; // string;

//   /**
//    * Whether the pattern matches a problem for the whole file or for a location
//    * inside a file.
//    *
//    * Defaults to "location".
//    */
//   public $kind; // 'file' | 'location';

//   /**
//    * The match group index of the filename.
//    */
//   public $file; // number;

//   /**
//    * The match group index of the problem's location. Valid location
//    * patterns are: (line), (line,column) and (startLine,startColumn,endLine,endColumn).
//    * If omitted the line and column properties are used.
//    */
//   public $location; // number;

//   /**
//    * The match group index of the problem's line in the source file.
//    * Can only be omitted if location is specified.
//    */
//   public $line; // number;

//   /**
//    * The match group index of the problem's column in the source file.
//    */
//   public $column; // number;

//   /**
//    * The match group index of the problem's end line in the source file.
//    *
//    * Defaults to undefined. No end line is captured.
//    */
//   public $endLine; // number;

//   /**
//    * The match group index of the problem's end column in the source file.
//    *
//    * Defaults to undefined. No end column is captured.
//    */
//   public $endColumn; // number;

//   /**
//    * The match group index of the problem's severity.
//    *
//    * Defaults to undefined. In this case the problem matcher's severity
//    * is used.
//    */
//   public $severity; // number;

//   /**
//    * The match group index of the problem's code.
//    *
//    * Defaults to undefined. No code is captured.
//    */
//   public $code; // number;

//   /**
//    * The match group index of the message. Defaults to 0.
//    */
//   public $message; // number;

//   /**
//    * Specifies if the last pattern in a multi line problem matcher should
//    * loop as long as it does match a line consequently. Only valid on the
//    * last problem pattern in a multi line problem matcher.
//    */
//   public $loop; // boolean;
// }

// SKIPPING
/**
 * A description to when and how run a task.
 */
// class RunOptions {
//   /**
//    * Controls how variables are evaluated when a task is executed through
//    * the Rerun Last Task command.
//    * The default is `true`, meaning that variables will be re-evaluated when
//    * a task is rerun. When set to `false`, the resolved variable values from
//    * the previous run of the task will be used.
//    */
//   public $reevaluateOnRerun; // boolean;

//   /**
//    * Specifies when a task is run.
//    *
//    * Valid values are:
//    *   "default": The task will only be run when executed through the Run Task command.
//    *   "folderOpen": The task will be run when the containing folder is opened.
//    */
//   public $runOn; // string;
// }

?>