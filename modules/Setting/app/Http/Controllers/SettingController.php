<?php

namespace Modules\Setting\app\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\app\Http\Requests\SettingRequest;
use Modules\Setting\app\Models\Setting;
use Modules\Setting\app\Services\SettingService;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
        $setting = Setting::first();
        $roles = Role::all();
        $data = json_decode($setting->data);

        return view('setting::setting.index', compact('setting', 'roles', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Renderable
     */
    public function create()
    {
        return view('setting::setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('setting::setting.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('setting::setting.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Renderable
     */
    public function update(SettingRequest $request, Setting $setting, SettingService $settingService)
    {
        return $settingService->update($request, $setting)
            ? back()->with('success', 'Setting has been updated successfully!')
            : back()->with('failed', 'Setting was not updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
