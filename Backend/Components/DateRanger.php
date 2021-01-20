<?php


namespace App\Backend\Components;

use Illuminate\View\Component;

class DateRanger extends Component
{
    public $field;
    public $from;
    public $to;

    public function __construct($field, $from, $to)
    {
        $this->field = $field;
        $this->from = $from;
        $this->to = $to;
    }

    public function render()
    {
        return view('B::components.date-ranger.date-ranger');
    }
}
