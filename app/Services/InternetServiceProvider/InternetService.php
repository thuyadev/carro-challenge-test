<?php

namespace App\Services\InternetServiceProvider;

abstract class InternetService
{
    public function setMonth(int $month): void
    {
        $this->month = $month;
    }

    public function calculateTotalAmount(): int|float
    {
        return $this->month * $this->monthlyFees;
    }
}