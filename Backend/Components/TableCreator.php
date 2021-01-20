<?php


namespace App\Backend\Components;

use Illuminate\View\Component;

class TableCreator extends Component
{
    public $items;
    public $columns;
    public $model;

    public function __construct($items, $columns, $model)
    {
        $this->items = $items;
        $this->columns = $columns;
        $this->model = $model;

        /*if (method_exists($model,'getDashBoardSearchFields')) {

            $searchFields = $model::getDashBoardSearchFields();

            foreach ($columns as $column => $attrs) {
                if (is_array($attrs) && array_key_exists($column, $searchFields)) {
                        $this->columns[$column]['search'] = $searchFields[$column];
                }
            }
        }*/
    }

    public function render()
    {
        return view('B::components.table-creator.table-creator');
    }
}
