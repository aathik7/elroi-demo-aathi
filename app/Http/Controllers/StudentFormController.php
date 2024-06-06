<?php

namespace App\Http\Controllers;

use App\Models\StudentEducation;
use App\Models\StudentForm;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StudentFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentDetails = StudentForm::with([
            'education' => function ($q) {
                $q->select('id', 'student_id', 'qualification');
            }
        ])->orderByDesc('created_at')->get(['id', 'name', 'active_flag']);
        return view('student.index', ['studentDetails' => $studentDetails]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'image' => 'required'
        ]);
        $request['hobbies'] = $this->updateHobbies($request->all());
        if (!empty($request['image'])) {
            Storage::disk('local')->put('image' . time() . '.png', file_get_contents($request->image));
        }
        $student = StudentForm::create($request->all());
        if ($request['qualification_details'] == 1 && !empty($student)) {
            StudentEducation::insert([
                [
                    'student_id' => $student['id'],
                    'qualification' => '10th',
                    'year_of_passing' => $request['10_Year'],
                    'university_name' => $request['10_univercity']
                ],
                [
                    'student_id' => $student['id'],
                    'qualification' => '12th',
                    'year_of_passing' => $request['12_Year'],
                    'university_name' => $request['12_univercity']
                ],
                [
                    'student_id' => $student['id'],
                    'qualification' => 'ug',
                    'year_of_passing' => $request['ug_Year'],
                    'university_name' => $request['ug_univercity']
                ]
            ]);
        }
        return redirect()->route('student.index')->with('success', 'Student Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $studentDetail = StudentForm::with([
            'education' => function ($q) {
                $q->select('id', 'student_id', 'qualification', 'year_of_passing', 'university_name');
            }
        ])->where('id', $id)->first(['id', 'name', 'hobbies', 'active_flag'])->toArray();
        $studentDetail = $this->getHobbies($studentDetail);
        return view('student.edit', ['studentDetail' => $studentDetail]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required'
        ]);
        $request['hobbies'] = $this->updateHobbies($request->all());
        StudentForm::where('id', $request['id'])->update(['name' => $request['name'], 'hobbies' => $request['hobbies']]);
        StudentEducation::where('student_id', $request['id'])->delete();
        if ($request['qualification_details'] == 1 && !empty($request['id'])) {
            StudentEducation::insert([
                [
                    'student_id' => $request['id'],
                    'qualification' => '10th',
                    'year_of_passing' => $request['10_Year'],
                    'university_name' => $request['10_univercity']
                ],
                [
                    'student_id' => $request['id'],
                    'qualification' => '12th',
                    'year_of_passing' => $request['12_Year'],
                    'university_name' => $request['12_univercity']
                ],
                [
                    'student_id' => $request['id'],
                    'qualification' => 'ug',
                    'year_of_passing' => $request['ug_Year'],
                    'university_name' => $request['ug_univercity']
                ]
            ]);
        }
        return redirect()->route('student.index')->with('success', 'Student Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        StudentForm::where('id', $request['id'])->delete();
    }

    public function updateHobbies($params) {
        $text = '';
        $text .= !empty($params['books']) ? ',books' : '';
        $text .= !empty($params['games']) ? ',games' : '';
        $text .= !empty($params['painting']) ? ',painting' : '';
        $text .= !empty($params['gardening']) ? ',gardening' : '';
        $text .= !empty($params['learning']) ? ',learning' : '';
        return $text;
    }

    public function getHobbies($params) {
        $hobbies = !empty($params['hobbies']) ? explode(',', $params['hobbies']) : [];
        $params['books'] = in_array('books', $hobbies) ? "1" : "0";
        $params['games'] = in_array('games', $hobbies) ? "1" : "0";
        $params['painting'] = in_array('painting', $hobbies) ? "1" : "0";
        $params['gardening'] = in_array('gardening', $hobbies) ? "1" : "0";
        $params['learning'] = in_array('learning', $hobbies) ? "1" : "0";
        return $params;
    }
}
