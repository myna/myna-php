<?php

class Experiment {

    public function __construct($experiment, $session, $api, $sticky = true) {
        $this->experiment = $experiment;
        $this->session = $session;
        $this->api = $api;
        $this->sticky = $sticky;
    }

    public function suggest() {

        if($this->sticky) {
            $variant = $session.get();
            if($variant) {
                return $variant;
            } else {
            }
        } else {
            $variant = $experiment.suggest();
            // Need to remember the variant for later rewarding
            $session.put($variant);
            return $variant;
        }
    }

    /**
     * Record that this variant was viewed without it being suggested
     * by this Experiment. This is useful if you want to use your own
     * business rules to decide on which variant is displayed, but
     * still want to update Myna's statistics. This variant will
     * replace any previously suggested variant in the cache, and will
     * be rewarded on call to reward.
     *
     * @param (Variant or String) variantOrId. The Variant or the ID of the Variant to view.
     */
    public function view($variantOrId) {

    }

    public function reward($amount = 1.0) {

    }


    protected function getAndSaveSuggestion() {
        $variant = $this->experiment.suggest();
        $this->session.put($variant);
        return $variant;
    }

}

?>
