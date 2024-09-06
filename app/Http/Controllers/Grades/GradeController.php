<?php

namespace App\Http\Controllers\Grades;

 //namespace App\Http\Controllers;
 use App\Http\Controllers\Controller;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGrades;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $Grades=Grade::all();
        return view('pages.Grades.Grades',compact('Grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGrades $request)
    {
        //
        if (Grade::where('Name->ar', $request->Name)->orWhere('Name->en',$request->Name_en)->exists()) {

            return redirect()->back()->withErrors(trans('Grades_trans.exists'));
         

        }
  
        try {
            $validated = $request->validated();

        $Grade=new Grade();
        
        $Grade->Name= ['en'=>$request->Name_en,'ar'=>$request->Name];
        $Grade->Notes=$request->Notes;
        $Grade->save();
        toastr()->success(trans('messages.success'));

            return redirect()->route('Grades.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error',$e->getMessage()]);
        }
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        //
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreGrades $request,$id )
    {
        //
       // return $id;
        try {
            $validated = $request->validated();
            $Grades =Grade::findOrFail($id);
            
            $Grades->update([
                'Name'=> ['en'=>$request->Name_en,'ar'=>$request->Name],
                'Notes' => $request->Notes
            ]);

            toastr()->success(trans('messages.Update'));

            return redirect()->route('Grades.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->withErrors(['error',$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $Grades = Grade::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('Grades.index');
    }
}
