@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Registrar Pedido</h3>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="mesa" class="form-label">Mesa</label>
            <input type="number" name="mesa" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="mesero" class="form-label">Mesero</label>
            <select name="mesero" id="mesero" class="form-select" required>
                <option value="">Seleccionar Mesero</option>
                @foreach ($meseros as $mesero)
                    <option value="{{ $mesero->nombres }}">{{ $mesero->nombres }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="producto" class="form-label">Producto</label>
            <select name="producto" class="form-select" id="producto" required>
                <option value="">Seleccionar Producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->nombre_producto }}" data-precio="{{ $producto->precio_publico }}">
                        {{ $producto->nombre_producto }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="precio_publico" class="form-label">Precio al Público</label>
            <input type="text" name="precio_publico" id="precio_publico" class="form-control" readonly>
        </div>
        <div class="mb-3">
            <label for="total" class="form-label">Total</label>
            <input type="text" name="total" id="total" class="form-control" readonly>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>

<script>
    document.getElementById('producto').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const precio = selectedOption.getAttribute('data-precio');
        document.getElementById('precio_publico').value = precio;

        calcularTotal();
    });

    document.getElementById('cantidad').addEventListener('input', calcularTotal);

    function calcularTotal() {
        const cantidad = parseFloat(document.getElementById('cantidad').value) || 0;
        const precio = parseFloat(document.getElementById('precio_publico').value) || 0;
        document.getElementById('total').value = (cantidad * precio).toFixed(2);
    }
</script>
@endsection
