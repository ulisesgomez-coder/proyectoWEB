@foreach ([
    'exito' => ['#dcfce7', '#14532d'],
    'aviso' => ['#fef3c7', '#78350f'],
    'error' => ['#fef2f2', '#991b1b'],
] as $tipo => $colores)

    @if (session($tipo))
        <div
            role="alert"
            class="mb-4 rounded-lg border p-4"
            style="background: {{ $colores[0] }}; color: {{ $colores[1] }};"
        >
            {{ session($tipo) }}
        </div>
    @endif

@endforeach