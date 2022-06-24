<?php

namespace Gopayee\CashierRegister\Models\Stripe;

use Laravel\Cashier\Subscription as CashierSubscription;
use Gopayee\CashierRegister\Concerns\HasPlans;
use Gopayee\CashierRegister\Concerns\HasQuotas;

class Subscription extends CashierSubscription
{
    use HasPlans;
    use HasQuotas;

    /**
     * Get the service plan identifier for the resource.
     *
     * @return void
     */
    public function getPlanIdentifier()
    {
        return $this->stripe_price;
    }
}
