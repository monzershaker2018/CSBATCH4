<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Semester;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        $semesters = Semester::all();
        $subjects  = Subject::all();
        return view('Pages.subjects.subject',compact('sections','semesters','subjects'));
    }


    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70|unique:subjects,name',
       ]);
      Subject::create($request->all());
      $notification = array(
        'message' => 'تم إضافة البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('subjects.index')->with($notification);
    }





    public function update(Request $request)
    {
       // return $request->all();
        $this->validate($request , [
            'name' => 'required|min:3|max:70 |unique:sections,name',
       ]);
      Subject::findOrFail($request->id)->update($request->all());
     $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('subjects.index')->with($notification);
    }


    public function destroy(Request $request)
    {
     //  return $request->all();

        $id = $request->id;
        $data =   Subject::findOrFail($id)->Attachments()->get();
    
          if ( count($data) > 0 ) {
         
            return redirect()-> route('subjects.index')->with('error','عفوا لا يمكن حذف القسم لانه يحتوي علي مرفقات ');
          }else{

              $subject  = Subject::find( $request->id)->where('name' ,$request->name )->pluck('name')->first(); 
            $path = 'images/Attachments/' .$subject;
             if (File::exists($path)) File::deleteDirectory($path);
            Subject::findOrFail($request->id)->delete();
            $notification = array(
                'message' => 'تم حذف البيانات بنجاح',
                'alert-type' => 'success'
            );
            return redirect()-> route('subjects.index')->with($notification);
          }

 
    }


    public function getsemesters($id)
    {
        $products = DB::table("semesters")->where("section_id", $id)->pluck("name", "id");
        return json_encode($products);
    }

    public function getAttach($id){
        $sections = Section::all();
        $semesters = Semester::all();
        $subjects  = Subject::all();
        $attachments = Attachment::where("subject_id", $id)->get();
        return view('Pages.attachemnts.attachments',compact('subjects','sections','semesters','attachments'));

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

       return view('Pages.subjects.subject' ,
        compact('list_classes','semester_id','section_id',
        'section_name','semester_name','sections'));

}



    }

}
