<?php namespace Myna;

class BaseExperiment {


    public function __construct($options = array()) {
        $uuid = Arr::get_or_error($options, 'uuid', "Myna::BaseExperiment.constructor");
        $id = Arr::get_or_error($options, 'id', "Myna::BaseExperiment.constructor");
        $settings = new Settings(Arr::get($options, 'settings', array()));

    }

}

?>