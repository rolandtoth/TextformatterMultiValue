<?php

/**
 * Class TFMultiValueRow
 */
class TFMultiValueRow {

	/**
	 * Return key value when called directly.
	 *
	 * @return string
	 */
	public function __toString() {
		return !empty($this->value) ? $this->value : "";
	}
}
