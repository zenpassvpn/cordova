<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Activity Log
 *
 * An alternative to CodeIgniter's native log_message() function.
 * This function allows for more flexibility on how/where logs
 * will be written and can be useful for logging user activity.
 *
 * The optional second parameter can be any appropriate string
 * for describing the type of message. The optional third
 * parameter is the full path to the log file.
 *
 * @author  Sean Ephraim
 * @access	public
 * @param	  string  Log message
 * @param	  string  Type of message (i.e. 'INFO', 'ERROR')
 * @param	  string  The FULL path to the log file
 * @return  void
 */
if ( ! function_exists('activity_log')) {
	function activity_log($message, $level = 'ACTIVITY', $filename = NULL) {
    if ($filename === NULL) {
      // Default log path
      $filename = get_instance()->config->item('activity_log_path');
    }

    // Replace tabs with spaces in message
    $message = trim(preg_replace('/\s+/', ' ', $message));

    $level = strtoupper($level);
    $date = date(get_instance()->config->item('log_date_format'));
    $output = "$level\t$date\t$message\r\n";

    if ( ! @file_put_contents($filename, $output, FILE_APPEND))
    {
        error_log("Failed to access log file [$filename] for writing: $message");
    }
	}
}

/**
 * Include Analytics
 *
 * Includes tracking code for analytics (i.e. Google Analytics).
 * Supply your tracking code in application/config/analyticstracking.php
 *
 * @author  Sean Ephraim
 * @access	public
 * @return  void
 */
if ( ! function_exists('include_analytics')) {
	function include_analytics() {
    // Only include for production site
    if (ENVIRONMENT == 'production') {
      include_once(APPPATH . "config/analyticstracking.php");
    }
	}
}
