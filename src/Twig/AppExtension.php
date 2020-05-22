<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use App\Service\Helper;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\MixedPart;
use Symfony\Component\Mime\Part\Multipart\RelatedPart;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('age', [$this, 'getAge']),
            new TwigFilter('map_month', [$this, 'mapMonth']),
            new TwigFilter('mime_type', [$this, 'mimeType']),
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

    public function mimeType($file)
    {
        $mimeType = mime_content_type($file);
        $img = [
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',
        ];
        if (in_array($mimeType, $img)) {
            return 'image';
        }
        return $mimeType;
    }
}
