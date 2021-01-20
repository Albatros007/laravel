<?php

namespace App\Backend\Controllers;


class MainController extends Controller
{
    public function __construct()
    {
    }

    protected function errorRedirect($message = false)
    {
        $msg = !empty($message) ? $message : config('params.flash.errorDefault');

        return redirect()
            ->back()
            ->withInput()
            ->with('error', $msg);
    }

    protected function successRedirect($route, $message = false)
    {
        $msg = !empty($message) ? $message : config('params.flash.successDefault');

        return redirect()
            ->route($route)
            ->with('success', $msg);
    }
}
