<?php namespace task_manager_quick_action;

if ( !defined( 'ABSPATH' ) ) exit;

/**
 * @author Jimmy Latour <jimmy.eoxia@gmail.com>
 * @version 1.0
 */

class size_util extends singleton_util {
	protected function construct() {}

	/**
  * convert to - Convert format to "oc" or deconvert
  *
  * @param float $input
  * @param string $format
  * @param boolean $convert
  * @return float|number
  */
  public function convert_to($input, $format, $convert = true) {
		if($format == 'oc')
			return $input;
		$multiple = 0;
		if($format == 'ko')
			$multiple = 1024;
		else if($format == 'mo')
			$multiple = 1048576;
		else if($format == 'go')
			$multiple = 1073741824;
		if($convert)
			return $input * $multiple;
		else
			return $input / $multiple;
	}
}
