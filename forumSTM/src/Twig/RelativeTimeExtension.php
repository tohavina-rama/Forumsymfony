<?php
namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RelativeTimeExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('relative_time', [$this, 'relativeTime']),
        ];
    }

    public function relativeTime(\DateTimeInterface $date)
    {
        $now = new \DateTime();
        $diff = $now->diff($date);

        if ($diff->y > 0) return 'il y a ' . $diff->y . ' an' . ($diff->y > 1 ? 's' : '');
        if ($diff->m > 0) return 'il y a ' . $diff->m . ' mois';
        if ($diff->d > 0) return 'il y a ' . $diff->d . ' jour' . ($diff->d > 1 ? 's' : '');
        if ($diff->h > 0) return 'il y a ' . $diff->h . 'h';
        if ($diff->i > 0) return 'il y a ' . $diff->i . ' min';
        return 'à l\'instant';
    }
}
