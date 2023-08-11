<?php

namespace Modules\Setting\app\Services;

use Illuminate\Http\Request;
use Modules\Setting\app\Models\Setting;

class SettingService
{
    public function update(Request $request, Setting $setting): Setting|bool
    {
        return $setting->update([
            'name' => $setting->name,
            'data' => json_encode($request->validated()),
        ]);
    }
}
