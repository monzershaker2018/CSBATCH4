<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Section;
use App\Models\Semester;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; 
class AttachmentsController extends Controller
{

    public function index()
    {
        $sections = Section::all();
        $semesters = Semester::all();
        $attachments  = Attachment::all();
        $subjects  = Subject::all();


        return view('Pages.attachemnts.attachments',compact('subjects','sections','semesters','attachments'));

    }



    public function store(Request $request)
    {
     // $request->all();
      $this->validate($request , [
        'name' => 'required|min:3|max:70|unique:subjects,name',
        'source' => 'required|',
   ]);

   // $subject = DB::table('subjects')->where('id', $request-> subject_id)->select("name")->first();
   $subject  = Subject::find( $request->subject_id)->pluck('name')->first(); 
    
      //save image
       $file_ex = $request->source->getClientOriginalExtension();
        $file_name = time() .'.'. $file_ex;
     $path = 'images/Attachments/' .  $subject . '/' ;
      $request->source->move($path,$file_name);

      //insert to db
      Attachment::create([
          'name' => $request->name,
              'source' => $file_name,
              'subject_id' => $request->subject_id,

      ]);

  $notification = array(
    'message' => 'تم إضافة البيانات بنجاح',
    'alert-type' => 'success'
);
return redirect()-> route('attachments.index')->with($notification);
    }




    public function update(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70|unique:subjects,name,'.$request->id,
            'source' => 'required|min:3|max:255',
       ]);

                //save image
            $file_ex = $request->source->getClientOriginalExtension();
            $file_name = time() .'.'. $file_ex;
            $path = 'images/Attachments';
            $request->source->move($path,$file_name);

            //insert to db
            Attachment::create([
                'name' => $request->name,
                    'source' => $file_name,
                    'subject_id' => $request->subject_id,

            ]);

      $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('attachments.index')->with($notification);
    }


    public function destroy(Request $request)
    {
         $attch =   Attachment::findOrFail($request->id);
          $file  = $attch->pluck('source')->first();
          $subject_id  = $attch->pluck('subject_id')->first();
           $folder  = Subject::find( $subject_id)->pluck('name')->first(); 
           $path = 'images/Attachments/' . $folder . '/' . $file ;
           if (File::exists($path)) File::delete($path);
        
      Attachment::findOrFail($request->id)->delete();
        $notification = array(
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('attachments.index')->with($notification);
    }

    public function getSubjects($id)
    {
        $products = DB::table("subjects")->where("semester_id", $id)->pluck("name", "id");
        return json_encode($products);
    }

    public function download_file($subject , $source)

    {

         $file  = 'images/Attachments/'.$subject . '/' . $source;
       return response()->download($file);
    }



    public function show_file($subject , $source)
    {
       // return $subject;

        $file  = 'images/Attachments/'.$subject . '/' . $source;
       return response()->file($file);
    }
}
