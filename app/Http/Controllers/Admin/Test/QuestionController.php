<?php

namespace App\Http\Controllers\Admin\Test;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $request->validate([
            'question' => 'required',
            'a1' => 'required',
            'correct_answer' => 'required',
            'group_id' => 'required',
        ]);
        $group = Group::find($request['group_id']);
        $request['degree'] = $request['degree'] ?? Group::find($request['group_id'])->section->degree;
        if ($group->questions->count() < $group->section->max)
            Group::find($request['group_id'])->questions()->create($request->all());
        else {
            toast('Max number is reached', 'error');
            return redirect()->back();
        }
        toast('Question added successfully', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'question' => 'required',
            'a1' => 'required',
            'correct_answer' => 'required',
        ]);
        $request['degree'] = $request['degree'] ?? $question->group->section->degree;
        $question->update($request->all());
        toast('Modifications saved', 'success');
        return redirect()->route('admin.groups.show', $question['group_id']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        toast('Deleted successfully ', 'success');
        return redirect()->back();
    }
}
