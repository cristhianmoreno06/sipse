<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $courses = Course::all();
        return view('course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'course_name' => 'required',
            'teacher_responsible' => 'required',
            'start_date' => 'required',
            'date_completion' => 'required',
            'room_number' => 'required',
        ];

        $message = [
            'course_name.required' => 'El nombre del curso es obligatorio',
            'teacher_responsible.required' => 'El nombre del profesor es obligatorio',
            'start_date.required' => 'La fecha de inicio de curso es obligatorio',
            'date_completion.required' => 'La fecha de finalización de curso es obligatorio',
            'room_number.required' => 'El número de salon es obligatorio',
        ];

        $this->validate($request, $rules, $message);
        $newCourse= new Course();
        $newCourse->course_name = $request->get('course_name');
        $newCourse->teacher_responsible = $request->get('teacher_responsible');
        $newCourse->start_date = $request->get('start_date');
        $newCourse->date_completion = $request->get('date_completion');
        $newCourse->room_number = $request->get('room_number');

        if ($newCourse->save()) {
            $notificationSuccess = 'El curso Se ha registrado correctamente!';
            return redirect()->route('course.list')->with(compact('notificationSuccess'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Course $course
     * @return Application|Factory|View
     */
    public function edit(Course $course)
    {
        return view('course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function update(Request $request, Course $course)
    {
        $rules = [
            'course_name' => 'required',
            'teacher_responsible' => 'required',
            'start_date' => 'required',
            'date_completion' => 'required',
            'room_number' => 'required',
        ];

        $message = [
            'course_name.required' => 'El nombre del curso es obligatorio',
            'teacher_responsible.required' => 'El nombre del profesor es obligatorio',
            'start_date.required' => 'La fecha de inicio de curso es obligatorio',
            'date_completion.required' => 'La fecha de finalización de curso es obligatorio',
            'room_number.required' => 'El número de salon es obligatorio',
        ];

        $this->validate($request, $rules, $message);

        $course->course_name = $request->get('course_name');
        $course->teacher_responsible = $request->get('teacher_responsible');
        $course->start_date = $request->get('start_date');
        $course->date_completion = $request->get('date_completion');
        $course->room_number = $request->get('room_number');

        if ($course->save()) {
            $notificationSuccess = 'El curso Se ha registrado correctamente!';
            return redirect()->route('course.list')->with(compact('notificationSuccess'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Course $course
     * @return RedirectResponse
     */
    public function destroy(Course $course)
    {
        $deleteName = $course->course_name;
        $course->delete();
        $notificationSuccess = 'El curso '. $deleteName. ' Se ha eliminado correctamente!';
        return redirect()->route('course.list')->with(compact('notificationSuccess'));
    }
}
