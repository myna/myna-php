<?php namespace Myna\Data;

class Experiment {

  /**
    * Construct an Experiment from an Array of data
    */
  public static function fromArray($options) {
      $name = "\Myna\Data\Experiment::fromArray";

      $uuid     = \Myna\Arr::get_or_error($options, 'uuid', $name);
      $id       = \Myna\Arr::get_or_error($options, 'id', $name);
      $settings = Settings::fromArray(\Myna\Arr::get($options, 'settings', array()));
      $variants = array();

      $vars = \Myna\Arr::get($options, 'variants', array());
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
    * @param $variants: Array[String, Variant]
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

      foreach($this->variants as $id => $variant) {
          $total -= $variant->weight;
          if($total <= $random) {
              return $variant;
          }
      }

      return false;
  }

  /**
   * Get a Variant gives its ID, or false if no variant exists.
   *
   * @return Variant or false
   */
  public function variant($id) {
      return \Myna\Arr::get($this->variants, $id, false);
  }

  /**
   * True if this experiment is sticky. False otherwise.
   */
  public function is_sticky() {
      return $this->settings->is_sticky();
  }

  function totalWeight() {
      $total = 0.0;
      foreach($this->variants as $id => $variant) {
          $total += $variant->weight;
      }
      return $total;
  }

}

?>
