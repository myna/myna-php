<?php namespace Myna\Data;

class Settings {

  /**
    * Construct a Settings from an Array of data
    */
  public static function fromArray($options) {
      return new Settings($options);
  }

  /**
    * Construct a Settings
    *
    * @param $nodes: Array
    */
  public function __construct($nodes) {
      $this->nodes = $nodes;
  }

  /**
   * Returns true if the setting indicate this experiment is sticky.
   */
  public function is_sticky() {
      return \Myna\Arr::get_nested($this->nodes, array('myna', 'web', 'sticky'), true);
  }

}

?>
