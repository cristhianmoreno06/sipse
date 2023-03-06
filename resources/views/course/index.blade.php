@extends('layouts.dashboard')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Listado de cursos</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('course.create') }}" class="btn btn-sm btn-primary">Nuevo curso</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(session('notificationSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>Felicidades!</strong> {{ session('notificationSuccess') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @elseif(session('notificationError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>Error!</strong> {{ session('notificationError') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                <tr>
                    <th scope="col">Nombre del curso</th>
                    <th scope="col">Profesor del curso</th>
                    <th scope="col">Fecha de inicio del curso</th>
                    <th scope="col">Fecha de finalización del curso</th>
                    <th scope="col">Salon del curso</th>
                    <th scope="col">opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <th scope="row">
                            {{ $course->course_name }}
                        </th>
                        <td>
                            {{ $course->teacher_responsible }}
                        </td>
                        <td>
                            {{ date('Y-m-d', strtotime($course->start_date)) }}
                        </td>
                        <td>
                            {{ date('Y-m-d', strtotime($course->date_completion)) }}
                        </td>
                        <td>
                            {{ $course->room_number }}
                        </td>
                        <td>
                            <form action="{{ url('/course/delete/'.$course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ url('/course/'.$course->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
