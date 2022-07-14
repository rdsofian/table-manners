<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function form(){
        return view("student.import");
    }

    public function import(Request $request) {
        ini_set('max_execution_time', 3600);
        $this->validate($request, [
            'file'  => 'required|mimes:xls,xlsx,csv'
        ]);


        $path = $request->file('file')->getRealPath();

        $data = Excel::toArray([], $path);

        DB::beginTransaction();
        $message = "Error";
        $saved = true;
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                foreach ($value as $row) {
                    $student = new Student();
                    echo $row[3];
                    $date = intval($row[3]);

                    $birth_date = Date::excelToDateTimeObject($date)->format('Y-m-d');

                    $student->code = $row[0];
                    $student->name = $row[1];
                    $student->birth_place = $row[2];
                    $student->birth_date = $birth_date;
                    $student->address = $row[4];
                    $student->phone = $row[5];
                    $student->email = $row[6];
                    $student->group = $row[7];
                    $student->ipk = $row[8];
                    $student->year = $row[9];
                    $student = $saved && $student->save();
                }
            }
        }
        if ($saved) {
            DB::commit();
            return redirect()->route('student.index');
        } else {
            DB::rollBack();
            return back()->with('error', $message);
        }
    }

    public function group($group) {
        $students = Student::where('group', $group)->orderBy('name', 'ASC')->get();
        return view('student.index', compact('students'));
    }
}
