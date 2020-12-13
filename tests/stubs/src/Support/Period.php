<?php

namespace Stub\Support;

class Period extends \Spatie\Period\Period
{
    public function format(string $format = 'Y-m-d'): string
    {
        return $this->getStart()->format($format) . ' — ' . $this->getEnd()->format($format);
    }
}
