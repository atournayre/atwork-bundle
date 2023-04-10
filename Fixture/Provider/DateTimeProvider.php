<?php

namespace Atournayre\Bundle\AtWorkBundle\Fixture\Provider;

use Atournayre\Bundle\AtWorkBundle\Contracts\FixtureProvider;

class DateTimeProvider implements FixtureProvider
{
    public function currentDateWithTime(string $time): ?\DateTimeInterface
    {
        /** @var int[] $times */
        $times = explode(':', $time);

        return (new \DateTime())
            ->setTime(...$times);
    }

    public function randomHourWithDate(): ?\DateTimeInterface
    {
        $hours = range(0, 23);
        $hour = array_rand($hours);

        return (new \DateTime())
            ->setTime($hour, 0);
    }
}
