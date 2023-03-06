<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Kid;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class KidController extends Controller
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
        $kids = Kid::with('course')->paginate(10);
        return view('kids.index', compact('kids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $courses = Course::all();
        return view('kids.create', compact('courses'));
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
            'first_name' => 'required',
            'second_first_name' => 'required',
            'first_surname' => 'required',
            'identification_number' => 'required|min:8',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'course_id' => 'required',
        ];

        $message = [
            'first_name.required' => 'El primer nombre del estudiante es obligatorio',
            'second_first_name.required' => 'El segundo nombre del estudiante es obligatorio',
            'first_surname.required' => 'El primer apellido del estudiante es obligatorio',
            'identification_number.required' => 'El número de identificación del estudiante es requerido',
            'identification_number.min' => 'El número de identificación del estudiante debe contener una longitud minima de 8 caracteres',
            'gender.required' => 'El sexo del estudiante es obligatorio',
            'date_of_birth.required' => 'La fecha de nacimiento del estudiante es obligatoria',
            'course_id.required' => 'El curso al que se registra el estudiante es obligatorio',
        ];

        $this->validate($request, $rules, $message);
        $newKid = new Kid();
        $newKid->first_name = $request->get('first_name');
        $newKid->second_first_name = $request->get('second_first_name');
        $newKid->first_surname = $request->get('first_surname');
        $newKid->second_surname = $request->get('second_surname');
        $newKid->identification_number = $request->get('identification_number');
        $newKid->gender = $request->get('gender');
        $newKid->date_of_birth = $request->get('date_of_birth');
        $newKid->course_id = $request->get('course_id');

        if ($newKid->save()) {
            $notificationSuccess = 'El estudiante Se ha registrado correctamente!';
            return redirect()->route('kids.list')->with(compact('notificationSuccess'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Kid $kid
     * @return Application|Factory|View
     */
    public function edit(Kid $kid)
    {
        $courses = Course::all();
        $kid = $kid->with('course')->first();
        return view('kids.edit', compact('kid', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Kid $kid
     * @return RedirectResponse
     */
    public function update(Request $request, Kid $kid)
    {
        $rules = [
            'first_name' => 'required',
            'second_first_name' => 'required',
            'first_surname' => 'required',
            'identification_number' => 'required|min:8',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'course_id' => 'required',
        ];

        $message = [
            'first_name.required' => 'El primer nombre del estudiante es obligatorio',
            'second_first_name.required' => 'El segundo nombre del estudiante es obligatorio',
            'first_surname.required' => 'El primer apellido del estudiante es obligatorio',
            'identification_number.required' => 'El número de identificación del estudiante es requerido',
            'identification_number.min' => 'El número de identificación del estudiante debe contener una longitud minima de 8 caracteres',
            'gender.required' => 'El sexo del estudiante es obligatorio',
            'date_of_birth.required' => 'La fecha de nacimiento del estudiante es obligatoria',
            'course_id.required' => 'El curso al que se registra el estudiante es obligatorio',
        ];

        $this->validate($request, $rules, $message);

        $kid->first_name = $request->get('first_name');
        $kid->second_first_name = $request->get('second_first_name');
        $kid->first_surname = $request->get('first_surname');
        $kid->second_surname = $request->get('second_surname');
        $kid->identification_number = $request->get('identification_number');
        $kid->gender = $request->get('gender');
        $kid->date_of_birth = $request->get('date_of_birth');
        $kid->course_id = $request->get('course_id');

        if ($kid->save()) {
            $notificationSuccess = 'El estudiante Se ha actualizado correctamente!';
            return redirect()->route('kids.list')->with(compact('notificationSuccess'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Kid $kid
     * @return RedirectResponse
     */
    public function destroy(Kid $kid)
    {
        $deleteName = $kid->first_name.' '.$kid->first_surname;
        $kid->delete();
        $notificationSuccess = 'El estudiante '. $deleteName. ' Se ha eliminado correctamente!';
        return redirect()->route('kids.list')->with(compact('notificationSuccess'));
    }

    public function report()
    {
        $monthCounts = Kid::select(
            DB::raw('MONTH(date_of_birth) as month'),
            DB::raw('COUNT(1) as count'))
        ->groupBy('month')
        ->get()
        ->toArray();

        $counts = array_fill(0,12,0);
        foreach ($monthCounts as $monthCount) {
            $index = $monthCount['month']-1;
            $counts[$index] = $monthCount['count'];
        }

        return view('report.kids', compact('counts'));
    }
}
