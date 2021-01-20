<?php

namespace App\Models;

use App\Backend\Helpers\SortTrait;
use App\Backend\Helpers\TableNameTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MainModel extends Model
{
    use SortTrait;
    use TableNameTrait;

    protected static function prepareDateRangeForSearch($from, $to)
    {
        if (isset($from) && isset($to)) {

            $pattern = config('params.RegExpDate');

            if (preg_match($pattern, $from) && preg_match($pattern, $to)) {
                $from = Carbon::createFromFormat('d.m.Y', $from)->format('Y-m-d');
                $from .= ' 00:00:00';

                $to = Carbon::createFromFormat('d.m.Y', $to)->format('Y-m-d');
                $to .= ' 00:00:00';
            } else {
                return false;
            }

            return [$from, $to];
        }
    }
}
