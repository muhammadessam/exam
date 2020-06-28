<?php

namespace App\Http\Controllers\Admin\Test;

use App\Models\Section;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'time' => 'required|numeric',
            'reading' => 'required|numeric',
            'listening' => 'required|numeric',
            'ls' => 'required|numeric',
            'maxreading' => 'required|numeric',
            'maxlistening' => 'required|numeric',
            'maxls' => 'required|numeric',
            'reading_inst' => 'required',
            'listening_inst' => 'required',
            'ls_inst' => 'required',
        ]);
        if ($request->hasFile('logo_temp'))
            $request['logo'] = $this->storeFiles('logo', 'logo_temp');
        $setting->update([
            'time' => $request['time'],
            'logo' => $request->hasFile('logo_temp') ? $request['logo'] : Setting::MainSettings()->logo,
            'footer' => $request['footer']
        ]);
        Section::Reading()->update([
            'degree' => $request['reading'],
            'max' => $request['maxreading'],
            'instructions' => $request['reading_inst'],
        ]);

        Section::Listening()->update([
            'degree' => $request['listening'],
            'max' => $request['maxlistening'],
            'instructions' => $request['listening_inst'],
        ]);

        Section::LS()->update([
            'degree' => $request['ls'],
            'max' => $request['maxls'],
            'instructions' => $request['ls_inst'],
        ]);
        toast('Question added successfully', 'success');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Setting $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
