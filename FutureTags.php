<?php

namespace Statamic\Addons\Future;

use Carbon\Carbon;
use Statamic\Extend\Tags;
use InvalidArgumentException;

class FutureTags extends Tags
{
    /**
     * The {{ future }} tag
     *
     * @return string
     * @throws InvalidArgumentException
     */
    public function index()
    {
        $type         = $this->get('type', 'date');         // string: "date", "year", "month", or "day"
        $step         = $this->getInt('step', 1);           // integer: the stepping interval
        $limit        = $this->getInt('limit', 5);          // integer: the number of values to return
        $inclusive    = $this->getBool('inclusive', false); // boolean: whether to include the current date, year, month, or day
        $current_date = Carbon::now();
        $counter      = 0;
        $vars         = [];

        switch ($type) {

            case 'date' :
                if ($inclusive) $current_date->subDays($step);
                while ($counter < $limit) {
                    $vars[] = [
                        'value' => $current_date->addDays($step)->copy()
                    ];
                    $counter++;
                }
                break;

            case 'year' :
                if ($inclusive) $current_date->subYears($step);
                while ($counter < $limit) {
                    $vars[] = [
                        'value' => $current_date->addYears($step)->format('Y')
                    ];
                    $counter++;
                }
                break;

            case 'month' :
                if ($inclusive) $current_date->subMonths($step);
                while ($counter < $limit) {
                    $vars[] = [
                        'value' => $current_date->addMonths($step)->format('n')
                    ];
                    $counter++;
                }
                break;

            case 'day' :
                if ($inclusive) $current_date->subDays($step);
                while ($counter < $limit) {
                    $vars[] = [
                        'value' => $current_date->addDays($step)->format('j')
                    ];
                    $counter++;
                }
                break;

            default :
                throw new InvalidArgumentException('The "type" parameter must be set to one of the following: "date", "year", "month", or "day"');
        }

        // Parse
        return $this->parseLoop($vars);
    }
}
