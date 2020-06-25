<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Setting;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        try {
            $reading = Section::Reading()->groups->filter(function ($value) {
                return $value->description()->exists();
            })->random();
            $listening = Section::Listening()->groups->filter(function ($value) {
                return $value->audio()->exists();
            })->random();
            $ls = Section::LS()->groups->random();
            $audio = url($listening->audio->path);

        } catch (\InvalidArgumentException $exception) {
            alert()->error('Exam entries are not yet completed');
            return back()->withErrors($exception->getMessage());
        }
        return view('admin.test.index');
    }


    public function generate()
    {
        try {
            $reading = Section::Reading()->groups->filter(function ($value) {
                return $value->description()->exists();
            })->random();
            $listening = Section::Listening()->groups->filter(function ($value) {
                return $value->audio()->exists();
            })->random();
            $ls = Section::LS()->groups->random();
            $audio = asset($listening->audio->path);
            $logo = asset(Setting::MainSettings()->logo);
            $footer = Setting::MainSettings()->footer;

            return compact('reading', 'listening', 'ls', 'audio', 'logo', 'footer');
        } catch (\InvalidArgumentException $exception) {
            return back()->withErrors($exception->getMessage());
        }

    }


}
