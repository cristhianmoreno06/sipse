@extends('layouts.dashboard')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Editar estudiantes</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('kids.list') }}" class="btn btn-sm btn-success">
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
            <form action="{{ url('/kids/'. $kid->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="first_name">Primer Nombre del estudiante</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $kid->first_name) }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="second_first_name">Segundo Nombre del estudiante</label>
                        <input type="text" name="second_first_name" class="form-control" value="{{ old('second_first_name', $kid->second_first_name) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="first_surname">Primer Apellido del estudiante</label>
                        <input type="text" name="first_surname" class="form-control" value="{{ old('first_surname', $kid->first_surname) }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="second_surname">Segundo Apellido del estudiante</label>
                        <input type="text" name="second_surname" class="form-control" value="{{ old('second_surname', $kid->second_surname) }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="identification_number">Número de identificación del estudiante</label>
                        <input type="number" name="identification_number" class="form-control" value="{{ old('identification_number', $kid->identification_number) }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="gender">Sexo del estudiante</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="">Seleccione</option>
                            <option value="{{ old('gender', $kid->gender) }}" {{ ($kid->gender == 'masculino') ? 'selected' : '' }}>Masculino</option>
                            <option value="{{ old('gender', $kid->gender) }}" {{ ($kid->gender == 'femenino') ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="date_of_birth">Fecha de nacimiento del estudiante</label>
                        <input class="form-control" type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', date('Y-m-d', strtotime($kid->date_of_birth))) }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="course_id">Curso al que se registra el estudiante</label>
                        <select class="form-control" name="course_id" id="course_id">
                            <option value="">Seleccione</option>
                            <option value="{{ old('course_id', $kid->course_id) }}" selected>{{ $kid['course'][0]->course_name }}</option>
                            @foreach($courses as $course)
                                <option value="{{ old('course_id', $course->id) }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-sm btn-primary">Editar estudiante</button>
            </form>
        </div>
    </div>
@endsection
