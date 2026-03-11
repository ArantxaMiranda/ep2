{{-- Alerta de Éxito --}}
@if(session('success'))
    <div id="alerta-success" class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        <i class="fa-solid fa-circle-check"></i>
        <strong class="mx-2">¡Éxito!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            let alerta = document.getElementById('alerta-success');
            alerta.classList.remove('show');
            alerta.classList.add('fade');
            setTimeout(() => alerta.remove(), 500);
        }, 4000);
    </script>
@endif

{{-- Alerta de Error --}}
@if(session('error'))
    <div id="alerta-error" class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
        <i class="fa-solid fa-circle-xmark"></i>
        <strong class="mx-2">¡Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            let alerta = document.getElementById('alerta-error');
            alerta.classList.remove('show');
            alerta.classList.add('fade');
            setTimeout(() => alerta.remove(), 500);
        }, 4000);
    </script>
@endif

{{-- Alerta de Información --}}
@if(session('info'))
    <div id="alerta-info" class="alert alert-info alert-dismissible d-flex align-items-center fade show">
        <i class="fa-solid fa-circle-info"></i>
        <strong class="mx-2">Información:</strong> {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            let alerta = document.getElementById('alerta-info');
            alerta.classList.remove('show');
            alerta.classList.add('fade');
            setTimeout(() => alerta.remove(), 500);
        }, 4000);
    </script>
@endif

{{-- Alerta de Advertencia --}}
@if(session('warning'))
    <div id="alerta-warning" class="alert alert-warning alert-dismissible d-flex align-items-center fade show">
        <i class="fa-solid fa-triangle-exclamation"></i>
        <strong class="mx-2">¡Advertencia!</strong> {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        setTimeout(function() {
            let alerta = document.getElementById('alerta-warning');
            alerta.classList.remove('show');
            alerta.classList.add('fade');
            setTimeout(() => alerta.remove(), 500);
        }, 4000);
    </script>
@endif
