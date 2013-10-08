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

}

?>
