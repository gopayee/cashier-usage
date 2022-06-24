<?php

namespace Gopayee\CashierRegister\Concerns;

use Gopayee\CashierRegister\Feature;
use Gopayee\CashierRegister\MeteredFeature;
use Gopayee\CashierRegister\Plan;

trait HasFeatures
{
    /**
     * The features list for the instance.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $features = [];

    /**
     * Attach features to the instance.
     *
     * @param  array  $features
     * @return self
     */
    public function features(array $features)
    {
        $this->features = collect($features)->unique(function (Feature $feature) {
            return $feature->getId();
        });

        return $this;
    }

    /**
     * Inherit features from another plan.
     *
     * @param  \Gopayee\CashierRegister\Plan  $plan
     * @return self
     */
    public function inheritFeaturesFromPlan(Plan $plan, array $features = [])
    {
        $this->features = collect($features)
            ->merge($plan->getFeatures())
            ->merge($this->getFeatures())
            ->unique(function (Feature $feature) {
                return $feature->getId();
            });

        return $this;
    }

    /**
     * Get the list of all features.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getFeatures()
    {
        return collect($this->features);
    }

    /**
     * Get the metered features.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getMeteredFeatures()
    {
        return $this->getFeatures()->filter(function ($feature) {
            return $feature instanceof MeteredFeature;
        });
    }

    /**
     * Get a specific feature by id.
     *
     * @param  \Gopayee\CashierRegister\Feature|string|int  $feature
     * @return \Gopayee\CashierRegister\Feature|null
     */
    public function getFeature($feature)
    {
        if ($feature instanceof Feature) {
            $feature = $feature->getId();
        }

        return $this->getFeatures()->first(function (Feature $f) use ($feature) {
            return $f->getId() == $feature;
        });
    }
}
