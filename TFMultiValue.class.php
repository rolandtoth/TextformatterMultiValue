<?php

/**
 * Class TFMultiValue
 */
class TFMultiValue {

	static $original;

	public function __construct($value = "") {
		$this::$original = $value;
	}

	/**
	 * Return original field value when called directly.
	 *
	 * @return string
	 */
	public function __toString() {
		return $this::$original;
	}

	/**
	 * Overloaded getter.
	 *
	 * @param $var
	 *
	 * @return mixed
	 */
	public function __get($var) {
		if (is_callable(array($this, $var))) {
			return call_user_func(array($this, $var));
		}
	}

	/**
	 * Get number of rows the field contains.
	 *
	 * @return int
	 */
	private function count() {
		return (int) count(get_object_vars($this));
	}

	/**
	 * Get original field value (unmodified).
	 *
	 * @return string
	 */
	private function original() {
		return $this::$original;
	}
}
