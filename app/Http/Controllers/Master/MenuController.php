<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Http\Request;
use Route;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // redirect if roles is not exist
        if (!$request->roles) {
            return redirect()->route('master.menu.index', ['roles' => 1]);
        }

        // get menu_id if exist
        $menu = null;
        $type = null;
        if ($request->id) {
            $menu   = Menu::findOrFail($request->id);
            $type   = strlen($menu->level) > 2 ? 'Child' : 'Parent';
        } else {
            $menu   = new Menu();
        }

        $all_roles  = Role::all();
        $roles      = Role::find($request->roles)->role;
        $list       = Menu::where('roles_id', $request->roles)->orderBy('level', 'ASC')->get();

        $data = [
            'all_roles' => $all_roles,
            'roles'     => ucfirst($roles),
            'list'      => $list,
            'menu'      => $menu,
            'menuType'  => $type
        ];

        // dd($data);
        return view('main.master.menu.all')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $roles = Role::findOrFail($request->roles);

        // validate level
        $temp_level = (int) $request->level;
        $level = ($temp_level < 10) ? '0' . $temp_level : $temp_level;

        if (!$request->id) {
            // Insert
            $menu               = new Menu();
            $menu->roles_id     = $request->roles;
            $menu->menu         = $request->menu;
            $menu->icon         = $request->icon;
            $menu->icon_type    = $request->icon_type;
            $menu->active       = ($request->active == 'on') ? true : false;

            if ($request->route) {
                if (Route::has($request->route))
                    $menu->route = $request->route;
                else
                    return redirect()->route('master.menu.index', ['roles' => $roles, 'id' => $menu->id])->withInput()->with('errors', 'Route tidak ditemukan');
            } else {
                $menu->route = null;
            }

            if ($request->menuType == 'Parent') {
                $menu->level = $level;
            } else {
                $menu->level = $request->parent . $level;
            }

            // check level
            $exist = Menu::where('level', $menu->level)->where('roles_id', $menu->roles_id)->first();
            if ($exist) {
                return redirect()->route('master.menu.index', ['roles' => $roles])->withInput()->with('errors', 'Level sudah digunakan');
            }

            // Store into database
            if ($menu->save()) {
                return redirect()->route('master.menu.index', ['roles' => $roles])->with('success', 'Penambahan menu baru berhasil');
            } else {
                return redirect()->route('master.menu.index', ['roles' => $roles])->withInput();
            }
        } else {
            // Update
            $menu               = Menu::findOrFail($request->id);
            $old_level          = $menu->level;
            $menu->menu         = $request->menu;
            $menu->icon         = $request->icon;
            $menu->icon_type    = $request->icon_type;
            $menu->active       = ($request->active == 'on') ? true : false;

            if ($request->route) {
                if (Route::has($request->route))
                    $menu->route = $request->route;
                else
                    return redirect()->route('master.menu.index', ['roles' => $roles, 'id' => $menu->id])->withInput()->with('errors', 'Route tidak ditemukan');
            } else {
                $menu->route = null;
            }

            if ($request->menuType == 'Parent') {
                $menu->level = $level;
            } else {
                $menu->level = $request->parent . $level;
            }

            // check level
            $exist = Menu::where('level', $menu->level)->where('roles_id', $menu->roles_id)->where('id', '!=', $menu->id)->first();
            if ($exist) {
                return redirect()->route('master.menu.index', ['roles' => $roles, 'id' => $menu->id])->withInput()->with('errors', 'Level sudah digunakan');
            }

            // Update database
            if ($menu->update()) {
                if ($request->menuType == 'Parent') {
                    $childs = Menu::where('level', 'LIKE', $old_level . '%')->where('roles_id', $menu->roles_id)->whereNotNull('route')->get();

                    foreach ($childs as $child) {
                        $child->level = $menu->level . substr($child->level, 2, 2);
                        $child->update();
                    }
                }
                return redirect()->route('master.menu.index', ['roles' => $roles])->with('success', 'Perubahan menu berhasil');
            } else {
                return redirect()->route('master.menu.index', ['roles' => $roles, 'id' => $menu->id])->withInput();
            }
        }
    }

    // Delete data
    public function delete($roles, $id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->delete()) {
            return redirect()->route('master.menu.index', ['roles' => $roles])->with('success', 'Menu berhasil dihapus');
        } else {
            return redirect()->route('master.menu.index', ['roles' => $roles, 'id' => $id])->with('errors', 'Terjadi kesalahan, silahkan coba kembali');
        }
    }

    public function cek()
    {
        return view('main.master.menu.form');
    }
}
