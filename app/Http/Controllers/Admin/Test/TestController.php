<?php

namespace App\Http\Controllers\Admin\Test;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Setting;
use App\Test;
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
            $audio = url($listening->audio->path);
            $logo = url(Setting::MainSettings()->logo);
            $footer = Setting::MainSettings()->footer;
            $time = Setting::MainSettings()->time;
            return compact('reading', 'listening', 'ls', 'audio', 'logo', 'footer', 'time');
        } catch (\InvalidArgumentException $exception) {
            return back()->withErrors($exception->getMessage());
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'reading' => 'required',
            'listening' => 'required',
            'ls' => 'required',
            'student_name' => 'required',
            'student_id' => 'required',
        ]);
        Test::create($request->all());
        return 'Done';
    }

    public function students()
    {
        return view('admin.test.students');
    }

}
