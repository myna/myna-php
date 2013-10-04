<?php namespace Myna\Data;

class Variant {

  /**
    * Construct a Variant from an Array of data
    */
  public static function fromArray($options) {
    $id       = Arr::get_or_error($options, 'id', '\Myna\Data\Variant::fromArray');
    $name     = Arr::get($options, 'name', $id);
    $weight   = Arr::get_or_error($options, 'weight', '\Myna\Data\Variant::fromArray');
    $settings = Settings::fromArray(Arr::get($options, 'settings', array()));

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
  public function __construct($id, $name, $weight, $variants) {
    $this->id = $id;
    $this->name = $name;
    $this->weight = $weight;
    $this->settings = $settings;
  }

}

?>
