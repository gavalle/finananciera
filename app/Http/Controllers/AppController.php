<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{

    public function index(Request $request)
    {
        $user = new User();

        return view('app')
            ->with('user', $user ? $user : null)
            ->with('AT', $request->session()->get('access_token') ? $request->session()->get('access_token') : null);
    }

    public function index_public(Request $request)
    {
        $user = new User();
        return view('app')
            ->with('user', $user->id == null ? null : $user)
            ->with('AT', $user->id == null ? null : $request->session()->get('access_token'));
    }

    public function getMenu(Request $request)
    {
        $arr_menu = [];

        $user = new User();

        $permissions = $user->getPermissions();

        // Se comenta la validación de permisos para el menú mientra se finalizan todas las opciones.
        // DB::enableQueryLog();

        $menu_ppal = Menu::query()
            ->where('parent_id', '=', 0)
            ->orderBy('ordering', 'asc')
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();

        foreach ($menu_ppal as $menu) {
            $menu_permission = !empty($menu['key_permission']) ? explode("|", $menu['key_permission']) : [];
            if ($this->checkPermissions($menu_permission, $permissions)) {
                $arr_menu[] = $menu;
            }
        }

        foreach ($arr_menu as &$menu) {
            $menu_childs = Menu::query()
                ->where('parent_id', '=', $menu['id'])
                ->orderBy('ordering', 'asc')
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();

            $menu['childs'] = [];
            foreach ($menu_childs as $menuc) {
                $menuc_permission = !empty($menuc['key_permission']) ? explode("|", $menuc['key_permission']) : [];
                if ($this->checkPermissions($menuc_permission, $permissions)) {
                    $menu['childs'][] = $menuc;
                }
            }
        }

        return response()->json($arr_menu);
    }

    public function checkPermissions($menu_permission, $permissions)
    {
        $add = false;
        if (!empty($menu_permission)) {
            foreach ($menu_permission as $mp) {
                if (in_array($mp, $permissions)) {
                    $add = true;
                }
            }
        } else {
            $add = true;
        }

        return $add;
    }
}
