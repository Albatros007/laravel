<?php
namespace App\Backend\Helpers;

class Views
{
    public static function sort($model, $thisField)
    {
        $sortField = $model::getSortField();
        $direction = $model::getSortDirection();
        $cssASC = $cssDESC = '';

        if ( $sortField == $thisField && $direction == 'ASC') {
            $cssASC = 'icon-current';
        }
        if ( $sortField == $thisField && $direction == 'DESC') {
            $cssDESC = 'icon-current';
        }

        //if ( $sortField ==  $thisField) {
            //if ($direction == 'ASC') {
                echo '<a href="'.request()->fullUrlWithQuery(['sort' => '-'.$thisField]).'">
                        <!--<span class="fa fa-arrow-circle-o-up sort-icon '.$cssDESC.'" aria-hidden="true"></span>!-->
                        <span class="fa fa-sort-amount-desc sort-icon '.$cssDESC.'" aria-hidden="true"></span>
                      </a>';
            //} else {
                echo '<a href="'.request()->fullUrlWithQuery(['sort' => $thisField]).'">
                         <!--<span class="fa fa-arrow-circle-o-down sort-icon '.$cssASC.'" aria-hidden="true"></span>!-->
                         <span class="fa fa-sort-amount-asc sort-icon '.$cssASC.'" aria-hidden="true"></span>
                       </a>';
            //}
        //}
    }
}
