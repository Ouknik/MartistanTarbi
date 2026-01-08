<?php

namespace App\Services;

use DateTime;

class AgeCalculator
{
    public function calculateAge($dateOfBirth)
    {
        $now = new DateTime();
        $dob = new DateTime($dateOfBirth);
        $age = $dob->diff($now)->y;
        return $age;
    }
}