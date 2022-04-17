<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {
        //
        $sections = Section::all();
        return view('Pages.sections.sections' , compact('sections'));
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
       $this->validate($request , [
        'name' => 'required|min:3|max:70 |unique:sections,name',
       ]);

       $section = Section::create($request->all());
       $notification = array(
        'message' => 'تم إضافة البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('sections.index')->with($notification);

    }




    public function update(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 |unique:sections,name,'.$request->id,
       ]);
      Section::findOrFail($request->id)->update($request->all());
     $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('sections.index')->with($notification);
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
      $data =   Section::findOrFail($id)->Semesters()->get();

      if ( count($data) > 0 ) {
     
        return redirect()-> route('sections.index')->with('error','عفوا لا يمكن حذف القسم لانه يحتوي علي فصول دراسية');
      }else{
        Section::findOrFail($request->id)->delete($request->all());
        $notification = array(
            'message' => 'تم حذف البيانات بنجاح',
            'alert-type' => 'success'
        );
        return redirect()-> route('sections.index')->with($notification);
      }

       
    }
}
