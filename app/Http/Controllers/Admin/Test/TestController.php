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
            $readingInst = Section::Reading()->instructions;
            $listeningInst = Section::Listening()->instructions;
            $lsInst = Section::LS()->instructions;
            return compact('reading', 'listening', 'ls', 'audio', 'logo', 'footer', 'time', 'readingInst', 'listeningInst', 'lsInst');
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
        ]);
        Test::create($request->all());
        return 'success';
    }

    public function students()
    {
        return view('admin.test.students');
    }

    public function getCertificate(Request $request, Test $test)
    {
        $overallResult = $test->reading + $test->listening + $test->ls;
        if ($overallResult >= 0 && $overallResult <= 40) {
            $test['level'] = 'One';
        } else if ($overallResult > 40 && $overallResult <= 60) {
            $test['level'] = 'Two';
        } else if ($overallResult > 60 && $overallResult <= 70) {
            $test['level'] = 'Three';
        } else if ($overallResult > 70 && $overallResult <= 80) {
            $test['level'] = 'Four';
        } else if ($overallResult > 80 && $overallResult <= 90) {
            $test['level'] = 'Five';
        } else if ($overallResult > 90 && $overallResult <= 100) {
            $test['level'] = 'Advanced';
        }
        return view('admin.certificates.template', compact('test'));
    }

}
