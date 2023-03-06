<!-- Navigation -->
<h6 class="navbar-heading text-muted">Administración de sistema</h6>
<ul class="navbar-nav">
    <li class="nav-item  active ">
        <a class="nav-link  active " href="{{ route('course.list') }}">
            <i class="ni ni-book-bookmark text-Warning"></i> Cursos
        </a>
    </li>
    <li class="nav-item  active ">
        <a class="nav-link  active " href="{{ route('kids.list') }}">
            <i class="ni ni-hat-3 text-Success"></i> Estudiantes
        </a>
    </li>
</ul>
<!-- Divider -->
<hr class="my-3">
<!-- Heading -->
<h6 class="navbar-heading text-muted">Reportes</h6>
<!-- Navigation -->
<ul class="navbar-nav mb-md-3">
    <li class="nav-item">
        <a class="nav-link" href="{{ route('report.kids') }}">
            <i class="fas fa-chart-pie text-Info"></i> Reporte de Registros
        </a>
    </li>
</ul>
<ul class="navbar-nav">
    <li class="nav-item active active-pro">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();">
            <i class="fas fa-sign-in-alt text-pink"></i> Cerrar sesión
        </a>
        <form action="{{ route('logout') }}" method="POST" class="d-none" id="formLogout"> @csrf </form>
    </li>
</ul>
