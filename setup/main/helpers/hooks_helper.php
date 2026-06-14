<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function add_action($hook, $function, $priority = 10) {
    $chi =& get_instance();
	$chi->load->library('abhooks');
	$chi->abhooks->add_action($hook,$function,$priority);
}

function do_action($hook) {
    $chi =& get_instance();
	$chi->load->library('abhooks');
	return $chi->abhooks->do_action($hook);
}

function has_action($hook, $function = null) {
    $chi =& get_instance();
    $chi->load->library('abhooks');

    return $chi->abhooks->has_action($hook, $function);
}
