<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return Inertia::render('Dashboard/Setting/Show', [
            "title" => "Dashboard - Setting",
            "settings" => Setting::first()

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return Inertia::render('Dashboard/Setting/Edit', [
            "title" => "Dashboard - Edit Setting",
            "settings" => Setting::first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting, $id)
    {

        $data = $request->validate([
            'app_name' => 'required',
            'app_logo' => 'nullable',
            'app_description' => 'required'
        ]);

        if ($request->file('app_logo')) {
            if ($setting->app_logo) {
                Storage::disk('public')->delete($setting->app_logo);
            }
            $ext = str_replace(' ', '-', $request->get('app_name'));
            $filename = strtolower($ext) . '.' . $request->file('app_logo')->getClientOriginalExtension();
            $data['app_logo'] = $request->file('app_logo')->storeAs(
                'logo',
                $filename,
                'public'
            );
        }
        $data['app_name'] = Str::title($request->get('app_name'));
        // return $data;
        Setting::where('id', $id)->update($data);

        return redirect()->route('setting')
            ->with('message', 'Setting berhasil diubah.');
    }
}
