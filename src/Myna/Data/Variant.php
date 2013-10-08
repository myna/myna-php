<?php namespace Myna\Data;

class Variant {

  /**
    * Construct a Variant from an Array of data
    */
  public static function fromArray($options) {
      $name = "\Myna\Data\Variant::fromArray";

      $id       = \Myna\Arr::get_or_error($options, 'id', $name);
      $name     = \Myna\Arr::get($options, 'name', $id);
      $weight   = \Myna\Arr::get_or_error($options, 'weight', $name);
      $settings = Settings::fromArray(\Myna\Arr::get($options, 'settings', array()));

      return new Variant($id, $name, $weight, $settings);
  }

  /**
    * Construct a Variant
    *
    * @param $d: String
    * @param $name: String
    * @param $weight: Double
    * @param $settings: Setting
    */
  public function __construct($id, $name, $weight, $settings) {
      $this->id = $id;
      $this->name = $name;
      $this->weight = $weight;
      $this->settings = $settings;
  }

}

?>
