<?php namespace Myna;

class Experiment {

    public function __construct($experiment, $session, $api, $apiKey, $sticky = true) {
        $this->experiment = $experiment;
        $this->session = $session;
        $this->api = $api;
        $this->sticky = $sticky;
        $this->uuid = $experiment->uuid;
        $this->apiKey = $apiKey;
    }

    /**
     * Suggest a variant to display to the user. If this is a sticky
     * experiment and a variant has already been suggested, the same
     * variant is returned.
     *
     * @return Variant
     */
    public function suggest() {
        if($this->sticky) {
            $variantId = $this->session->get('view');
            if($variantId && $this->experiment->variant($variantId)) {
                return $this->experiment->variant($variantId);
            } else {
                return $this->getAndSaveSuggestion();
            }
        } else {
            return $this->getAndSaveSuggestion();
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
     * @param String variantId. The ID of the Variant to view.
     */
    public function view($variantId) {
        $this->api->view($this->apiKey, $this->uuid, $variantId);
        $this->session->put('view', $variantId);
    }

    /**
     * Reward the previously viewed or suggested variant. If no
     * variant has been viewed or suggested, does nothing.
     *
     * @param Double amount. The amount of reward to give, between 0.0 and 1.0.
     */
    public function reward($amount = 1.0) {
        if($this->session->get('reward')) {
            // We have already rewarded this variant. Do nothing.
        } else {
            $variant = $this->session->get('view');
            if($variant) {
                $this->api->reward($this->apiKey, $this->uuid, $variant, $amount);
            }
        }
    }


    protected function getAndSaveSuggestion() {
        $variant = $this->experiment->suggest();
        $this->api->view($this->apiKey, $this->uuid, $variant->id);
        $this->session->put('view', $variant->id);
        return $variant;
    }

}

?>
