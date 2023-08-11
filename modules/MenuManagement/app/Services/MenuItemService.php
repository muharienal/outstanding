<?php

namespace Modules\MenuManagement\app\Services;

use Illuminate\Http\Request;
use Modules\MenuManagement\app\Models\MenuGroup;
use Modules\MenuManagement\app\Models\MenuItem;

class MenuItemService
{
    public function create(Request $request, MenuGroup $menuGroup): MenuItem
    {
        return MenuItem::create(array_merge(
            $request->validated(),
            [
                'menu_group_id' => $menuGroup->id,
                'status' => ! blank($request->status) ? true : false,
                'posision' => $menuGroup->items()->max('posision') + 1,
            ]
        ));
    }

    public function update(Request $request, MenuGroup $menuGroup, MenuItem $menuItem): MenuItem|bool
    {
        return $menuItem->update(array_merge(
            $request->validated(),
            [
                'menu_group_id' => $menuGroup->id,
                'status' => ! blank($request->status) ? true : false,
            ]
        ));
    }
}
