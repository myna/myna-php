<?php namespace Myna;

class BaseExperiment {

    public static function fromArray($options) {
        $uuid     = Arr::get_or_error($options, 'uuid', "Myna::BaseExperiment.constructor");
        $id       = Arr::get_or_error($options, 'id', "Myna::BaseExperiment.constructor");
        $settings = new Settings(Arr::get($options, 'settings', array()));
        $variants = array();

        $vars = Arr::get($options, 'variants', array());
        foreach($vars as $data) {
            $variants[$data['id']] = Variant::fromArray($data);
        }

        return new BaseExperiment($uuid, $id, $settings, $variants);
    }

    // uuid (String)
    // id (String)
    // settings (String)
    // variants (String)
    public function __construct($uuid, $id, $settings, $variants) {
        $this->uuid = $uuid;
        $this->id = $id;
        $this->settings = $settings;
        $this->variants = $variants;
    }

    public function suggest() {
        $variants = $this->loadVariantsForSuggest();
        $this->viewVariant($variants);
    }

}

?>