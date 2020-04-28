<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use App\Service\Helper;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('age', [$this, 'getAge']),
            new TwigFilter('map_month', [$this, 'mapMonth']),
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

    public function mapMonth($index)
    {
        $months = Helper::monthsList();
        $result = array_filter($months, function ($item) use ($index) {
            return  $item['id'] == $index;
        });


        if (count($result) && is_int($index)) {
            return $result[$index - 1]['name'];
        }
        return '';
    }
}
