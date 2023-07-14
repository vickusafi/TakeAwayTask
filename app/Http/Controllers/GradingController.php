<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradingController extends Controller
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
        return view('grading.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //logic to grade students
    public function store(Request $request)
    {
        //
        //
        $this->validate($request, [
            'marks' => 'required',
            'grade' => 'required',
            'comments' => 'required',

        ]);
        $grading = new Grading();
        $grading->submission_id = $request->get('id');
        $grading->student_id = $request->get('student_id');
        $grading->grade = $request->grade;
        $grading->marks = $request->marks;
        $grading->comments = $request->comments;
        $grading->teacher_id = auth()->user()->id;
        $grading->save();

        //add logic to send emails and notifications 

        return redirect('/assignments')->with('success', 'Assignment Gradded Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
