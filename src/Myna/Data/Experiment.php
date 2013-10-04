<?php namespace Myna\Data;

class Experiment {

  /**
    * Construct an Experiment from an Array of data
    */
  public static function fromArray($options) {
    $uuid     = Arr::get_or_error($options, 'uuid', "Myna::Experiment.constructor");
    $id       = Arr::get_or_error($options, 'id', "Myna::Experiment.constructor");
    $settings = Settings::fromArray(Arr::get($options, 'settings', array()));
    $variants = array();

    $vars = Arr::get($options, 'variants', array());
    foreach($vars as $data) {
      $variants[$data['id']] = Variant::fromArray($data);
    }

    return new Experiment($uuid, $id, $settings, $variants);
  }

  /**
    * Construct an Experiment
    *
    * @param $uuid: String
    * @param $id: String
    * @param $settings: Setting
    * @param $variants: Array[Variant]
    */
  public function __construct($uuid, $id, $settings, $variants) {
    $this->uuid = $uuid;
    $this->id = $id;
    $this->settings = $settings;
    $this->variants = $variants;
  }

  /**
   * Get a suggestion from this Experiment
   *
   * @return A Variant or false if this Experiment has no variants
   */
  public function suggest() {
      $total = $this->totalWeight();
      $random = (mt_rand() / mt_getrandmax());

      foreach($this->variants as $variant) {
          $total -= $variant->weight;
          if($total <= $random) {
              return $variant;
          }
      }

      return false;
  }

  function totalWeight() {
      $total = 0.0;
      foreach($this->variants as $variant) {
          $total += $variant->weight;
      }
      return $total;
  }

}

?>
