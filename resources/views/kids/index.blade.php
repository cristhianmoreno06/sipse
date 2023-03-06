@extends('layouts.dashboard')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Listado de estudiantes</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ route('kids.create') }}" class="btn btn-sm btn-primary">Nuevo estudiante</a>
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
                    <th scope="col">Nombre</th>
                    <th scope="col">Curso</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Grupo etario</th>
                    <th scope="col">opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kids as $kid)
                    <tr>
                        <th scope="row">
                            {{ $kid->first_name. ' '. $kid->first_surname }}
                        </th>
                        <td>
                            {{ $kid['course'][0]->course_name }}
                        </td>
                        <td>
                            {{ \Carbon\Carbon::parse( date('Y-m-d', strtotime($kid->date_of_birth)))->age }}
                        </td>
                        <td>
                            @if(\Carbon\Carbon::parse( date('Y-m-d', strtotime($kid->date_of_birth)))->age < 5)
                                primera infancia
                            @elseif(\Carbon\Carbon::parse( date('Y-m-d', strtotime($kid->date_of_birth)))->age >= 5 && \Carbon\Carbon::parse( date('Y-m-d', strtotime($kid->date_of_birth)))->age <= 10)
                                Infante
                            @elseif(\Carbon\Carbon::parse( date('Y-m-d', strtotime($kid->date_of_birth)))->age >= 10 && \Carbon\Carbon::parse( date('Y-m-d', strtotime($kid->date_of_birth)))->age <= 13)
                                Preadolescente
                            @elseif(\Carbon\Carbon::parse( date('Y-m-d', strtotime($kid->date_of_birth)))->age >= 13 && \Carbon\Carbon::parse( date('Y-m-d', strtotime($kid->date_of_birth)))->age <= 18)
                                Adolescente
                            @elseif(\Carbon\Carbon::parse( date('Y-m-d', strtotime($kid->date_of_birth)))->age >= 18)
                                Adulto
                            @endif
                        </td>
                        <td>
                            <form action="{{ url('/kids/delete/'.$kid->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="{{ url('/kids/'.$kid->id.'/edit') }}" class="btn btn-sm btn-primary">Editar</a>
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-body">
            {{ $kids->links() }}
        </div>
    </div>
@endsection
