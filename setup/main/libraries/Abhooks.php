<?php
// application/libraries/Hooks.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Abhooks {
    private $hooks = array();

    public function add_action($hook, $function, $priority = 10) {
        if (!isset($this->hooks[$hook])) {
            $this->hooks[$hook] = array();
        }

        $this->hooks[$hook][] = array(
            'function' => $function,
            'priority' => $priority,
        );
    }
    
    public function has_action($hook, $function = null) {

        if (!isset($this->hooks[$hook])) {
            return false;
        }

        // Check only hook existence
        if ($function === null) {
            return true;
        }

        foreach ($this->hooks[$hook] as $action) {
            if ($action['function'] === $function) {
                return true;
            }
        }

        return false;
    }

    public function do_action($hook) {
        $output = '';

        if (isset($this->hooks[$hook])) {
            // Sort actions by priority
            usort($this->hooks[$hook], function ($a, $b) {
                return $a['priority'] - $b['priority'];
            });

            ob_start(); // Start output buffering

            foreach ($this->hooks[$hook] as $action) {
                call_user_func($action['function']);
            }

            $output = ob_get_contents(); // Get the output
            ob_end_clean(); // Clean the buffer
        }

        return $output;
    }
}
