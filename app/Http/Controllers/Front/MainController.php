<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index()
    {
        $sections = Section::all();
        $semesters = Semester::all();
        $subjects  = Subject::all();
        return view('welcome',compact('sections','semesters','subjects'));

    }

    public function search_subjects(Request $request)
    {

//return $request;

$sections = Section::all();
 $section_id = $request->section_id;
 $semester_id = $request->semester_id;

   $section_name = Section::select('*')->where('id','=',$section_id)->pluck('name')->first();
    $semester_name = Semester::select('*')->where('id','=',$semester_id)->pluck('name')->first();


 if($section_id && $semester_id){ //

            $list_classes = Subject::where([
        'section_id' => $section_id,
        'semester_id' => $semester_id

 ])->get();

       return view('welcome' ,
        compact('list_classes','semester_id','section_id',
        'section_name','semester_name','sections'));

}



    }

    public function getAttach($id){
        $sections = Section::all();
        $semesters = Semester::all();
        $subjects  = Subject::all();
        $attachments = Attachment::where("subject_id", $id)->get();
        return view('attachment',compact('subjects','sections','semesters','attachments'));

     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('Pages.index');
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
