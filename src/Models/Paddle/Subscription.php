<?php

namespace Gopayee\CashierRegister\Models\Paddle;

use Laravel\Paddle\Subscription as CashierSubscription;
use Gopayee\CashierRegister\Concerns\HasPlans;
use Gopayee\CashierRegister\Concerns\HasQuotas;

class Subscription extends CashierSubscription
{
    use HasPlans;
    use HasQuotas;

    /**
     * Get the service plan identifier for the resource.
     *
     * @return mixed
     */
    public function getPlanIdentifier()
    {
        return $this->paddle_plan;
    }
}
