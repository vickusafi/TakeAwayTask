<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignmentsubmissionController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //logic to submit assignments 

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'answers' => 'required',
            'file_name' => 'image|nullable|max:1999',
            'file_name.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ]);
        //handle the upload
        if ($request->hasFile('file_name')) {
            $file_name = $request->file('file_name');
            $file = $file_name->getClientOriginalName();
            $submission = new Submission();
            $submission->name = $request->name;
            $submission->file_name = $file;
            $submission->assignment_id = $request->get('id');
            $submission->student_id = auth()->user()->id;
            $submission->save();
            $model = $submission->id;
            if (!empty($model)) {
                $file->move(public_path() . '/uploads/assignment/' . $model, $file);
            }
            //add logic to notify students that assignments have been posted
            return redirect('/submissions')->with('success', 'Assignment submitted successfully');
        }
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
