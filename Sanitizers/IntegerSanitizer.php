<?php

	namespace Stoic\Input\Sanitizers;

	/**
	 * Class IntegerSanitizer
	 *
	 * @package Stoic\Input
	 * @version 1.0.0
	 */
	class IntegerSanitizer implements SanitizerInterface {

		/**
		 * Convert the supplied variable into an integer value.
		 *
		 * @param mixed $input The input that will be sanitized to an integer value.
		 *
		 * @throws \Exception
		 *
		 * @return integer
		 */
		public function sanitize($input) {
			try {
				if (is_object($input)) {
					$props = get_object_vars($input);
					$value = count($props);

				} else if (is_array($input)) {
					$value = count($input);

				// We are removing the period from the input so that strings
				// which contain float values aren't processed as strings.
				} else if (is_string($input) && !ctype_digit(str_replace('.', '', $input))) {
					$value = strlen($input);

				} else if (is_float($input)) {
					$value = round($input);

				} else {
					$value = intval($input);
				}
			} catch (\Exception $ex) {
				throw $ex;
			}

			return $value;
		}
	}