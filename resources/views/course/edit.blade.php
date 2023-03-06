@extends('layouts.dashboard')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar curso</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('course.list') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-chevron-left"></i>Regresar
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-exclamation-triangle"></i>
                        <strong>Por favor!!</strong> {{ $error }}!
                    </div>
                @endforeach
            @endif
            <form action="{{ url('/course/'. $course->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="course_name">Nombre del curso</label>
                        <input type="text" name="course_name" class="form-control" value="{{ old('course_name', $course->course_name) }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="teacher_responsible">Nombre del profesor - "responsable del curso"</label>
                        <input type="text" name="teacher_responsible" class="form-control" value="{{ old('teacher_responsible', $course->teacher_responsible) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="start_date">Fecha de inicio del curso</label>
                        <input class="form-control" type="date" id="start_date" name="start_date" value="{{ old('start_date', date('Y-m-d', strtotime($course->start_date))) }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="date_completion">Fecha de finalización del curso</label>
                        <input class="form-control" type="date" id="date_completion" name="date_completion" value="{{ old('date_completion', date('Y-m-d', strtotime($course->date_completion))) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="room_number">Número de salon del curso</label>
                        <input type="number" name="room_number" class="form-control" value="{{ old('room_number', $course->room_number) }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Editar curso</button>
            </form>
        </div>
    </div>
@endsection
