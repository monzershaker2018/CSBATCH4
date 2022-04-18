<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Section;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::all();
        $levels = Level::all();
        return view('Pages.levels.levels' , compact('sections' , 'levels'));

    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 ',
       ]);
       Level::create($request->all());
      $notification = array(
        'message' => 'تم إضافة البيانات بنجاح',
        'alert-type' => 'success'
    );

    return redirect()-> route('levels.index')->with($notification);


    }




    public function update(Request $request)
    {
        $this->validate($request , [
            'name' => 'required|min:3|max:70 |unique:levels,name,'.$request->id,
       ]);
       Level::findOrFail($request->id)->update($request->all());
     $notification = array(
        'message' => 'تم تحديث البيانات بنجاح',
        'alert-type' => 'success'
    );
    return redirect()-> route('levels.index')->with($notification);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

          $data =   Level::findOrFail($id)->Semesters()->get();

          if ( count($data) > 0 ) {

            return redirect()-> route('levels.index')->with('error','عفوا لا يمكن حذف القسم لانه يحتوي علي مواد دراسية');
          }else{
            Level::findOrFail($request->id)->delete();
            $notification = array(
                'message' => 'تم حذف البيانات بنجاح',
                'alert-type' => 'success'
            );
            return redirect()-> route('levels.index')->with($notification);
          }
    }
}
