<?php

namespace App\Http\Controllers\Admin\Test;

use App\Models\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Description;

class DescriptionController extends Controller
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
            'description' => 'required', 'group_id' => 'required|numeric|exists:groups,id'
        ]);
        $group = Group::find($request['group_id']);
        if ($group->description()->exists()) {
            $group->description()->update($request->except('_token'));
        } else {
            $group->description()->create($request->all());
        }
        toast('Description Added successfully', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Description $description
     * @return \Illuminate\Http\Response
     */
    public function show(Description $description)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Description $description
     * @return \Illuminate\Http\Response
     */
    public function edit(Description $description)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Description $description
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Description $description)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Description $description
     * @return \Illuminate\Http\Response
     */
    public function destroy(Description $description)
    {
        //
    }
}
