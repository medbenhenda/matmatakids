<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('age', [$this, 'getAge']),
        ];
    }

    public function getAge($date)
    {
        if (!$date instanceof \DateTime) {
            // turn $date into a valid \DateTime object or let return
            return null;
        }

        $referenceDate = date('01-01-Y');
        $referenceDateTimeObject = new \DateTime($referenceDate);
        $diff = $referenceDateTimeObject->diff($date);
        return $diff->y . ' Years';
    }
}
