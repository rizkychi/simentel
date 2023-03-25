<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use stdClass;

class MenuComposer
{
    public function compose(View $view)
    {
        $menu    = Menu::where('active', true)->where('roles_id', Auth::getUser()->roles_id)->whereRaw('LENGTH(level) = 2')->orderBy('level', 'ASC')->get();
        $submenu = Menu::where('active', true)->where('roles_id', Auth::getUser()->roles_id)->whereRaw('LENGTH(level) = 4')->orderBy('level', 'ASC')->get();

        $child = [];
        foreach ($submenu as $sub) {
            $level = substr($sub->level, 0, 2);
            $child[$level][] = $sub;
        }
        $parent = [];
        foreach ($menu as $m) {
            $x = new stdClass();
            $x = $m;
            $x->child = @$child[$m->level];
            $parent[] = $x;
        }
        $view->with('list_menu', $parent);
    }
}