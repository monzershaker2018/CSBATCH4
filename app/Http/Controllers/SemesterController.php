<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Semester;
use App\Models\Section;
use Illuminate\Http\Request;

class SemesterController extends Controller
{

    public function index()
    {
        $sections = Section::all();
        $semesters = Semester::all();
        $levels = Level::all();
        return view('Pages.semesters.semesters' , compact('levels','sections' , 'semesters'));
    }



    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 ',
       ]);
      Semester::create($request->all());
      $notification = array(
        'message' => 'تم إضافة البيانات بنجاح',
        'alert-type' => 'success'
    );

    return redirect()-> route('semesters.index')->with($notification);


    }



    public function update(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 |unique:semesters,name,'.$request->id,
       ]);
      Semester::findOrFail($request->id)->update($request->all());
     $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('semesters.index')->with($notification);
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
      $data =   Semester::findOrFail($id)->Subjects()->get();

        if ( count($data) > 0 ) {

          return redirect()-> route('semesters.index')->with('error','عفوا لا يمكن حذف القسم لانه يحتوي علي مواد دراسية');
        }else{
            Semester::findOrFail($request->id)->delete();
          $notification = array(
              'message' => 'تم حذف البيانات بنجاح',
              'alert-type' => 'success'
          );
          return redirect()-> route('semesters.index')->with($notification);
        }

    }
}
