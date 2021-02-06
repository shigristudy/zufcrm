<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Models\StudentStatus;
use App\Services\ImageOptimizer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function store(StudentRequest $request){
        
        $student = new Student();
        $student->student_type       = $request->student_type;
        $student->full_name          = $request->full_name;
        $student->father_name        = $request->father_name;
        $student->gender             = $request->gender;
        $student->city               = $request->city;
        $student->teacher_name       = $request->teacher_name;
        $student->class_name         = $request->class_name;
        $student->dob                = $request->dob;
        $student->student_id         = $request->student_id;
        $student->personal_statement = $request->personal_statement;
        $student->status             = $request->status;
        $student->province           = $request->province;
        $student->para_number        = $request->para_number;
        $student->dmg_ref            = $request->dmg_ref;
        $student->zuf_ref            = $request->zuf_ref;

        $image_name  = Str::slug($request->full_name, '-') . '_' . time() . '.png';
        $imageoptimze   = new ImageOptimizer;
        $imageoptimze->uploadBase64Image($request->profile_picture, 'project/' . $image_name, null, 400, true);

        $student->profile_picture    = $image_name;
        $student->save();

        return response()->json([
            'success'   => 1,
            'message'   => 'Student Added Successfully!'    
        ]);

    }

    public function update(StudentUpdateRequest $request){
           
        $student = Student::find($request->id);
        $student->student_type       = $request->student_type;
        $student->full_name          = $request->full_name;
        $student->father_name        = $request->father_name;
        $student->gender             = $request->gender;
        $student->city               = $request->city;
        $student->teacher_name       = $request->teacher_name;
        $student->class_name         = $request->class_name;
        $student->dob                = $request->dob;
        $student->student_id         = $request->student_id;
        $student->personal_statement = $request->personal_statement;
        $student->status             = $request->status;
        $student->province           = $request->province;
        $student->para_number        = $request->para_number;
        $student->dmg_ref            = $request->dmg_ref;
        $student->zuf_ref            = $request->zuf_ref;

        if($request->profile_picture != null){
            $image_name  = Str::slug($request->full_name, '-') . '_' . time() . '.png';
            $imageoptimze   = new ImageOptimizer;
            $imageoptimze->uploadBase64Image($request->profile_picture, 'project/' . $image_name, null, 400, true);
    
            $student->profile_picture    = $image_name;
        }
        $student->save();

        return response()->json([
            'success'   => 1,
            'message'   => 'Student Updated Successfully!'    
        ]);

    }

    public function getHafizStudents(Request $request){

        $columns = ['id','full_name', 'father_name', 'gender','teacher_name','class_name','student_id','sponsored'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Student::select($columns)
                    ->where('student_type','hafiz')
                    ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue,$columns) {
                foreach($columns as $c){
                    $query->orWhere($c, 'like', '%' . $searchValue . '%');
                }
            });
        }

        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }

    public function getScholarStudents(Request $request){
        $columns = ['id','full_name', 'father_name', 'gender','teacher_name','class_name','student_id','sponsored'];

        $length = $request->input('length');
        $column = $request->input('column'); //Index
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = Student::select($columns)
                    ->where('student_type','scholar')
                    ->orderBy($columns[$column], $dir);

        if ($searchValue) {
            $query->where(function($query) use ($searchValue,$columns) {
                foreach($columns as $c){
                    $query->orWhere($c, 'like', '%' . $searchValue . '%');
                }
            });
        }

        $projects = $query->paginate($length);
        return ['data' => $projects, 'draw' => $request->input('draw')];
    }


    public function getSingleStudent( $id ){
        $student = Student::with(['donations.item.product','donations.order.webhooks','statuses'])->find($id);
        return response()->json($student);
    }


    public function storeStatus( Request $request ){
        $this->validate($request, [
            'date' => 'required',
            'notes' => 'required',
        ]);
        $status = new StudentStatus();
        $status->date = $request->date;
        $status->notes = $request->notes;
        $status->student_id = $request->student_id;
        $status->save();
        return response()->json([
            'success'   => 1,
            'message'   => 'Status Update Successfully!'    
        ]);
    }
}
