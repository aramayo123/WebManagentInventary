@extends('layouts.app')
<style>
    .tab-content>.tab-pane {
        display: none;
        opacity: 0;
        transition: opacity 0.4s ease-in-out;
    }

    .tab-content>.tab-pane.show {
        display: block;
        opacity: 1;
    }

    .nav-tabs .nav-link.active {
        background-color: #f8f9fa;
        border-bottom: 3px solid #0d6efd;
        font-weight: bold;
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Navegación -->
                        <ul class="nav nav-tabs justify-content-center" id="tabs">
                            <li class="nav-item">
                                <button class="nav-link active" data-tab="inventario">Inventario</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-tab="ventas">Ventas</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-tab="resumen">Resumen</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-tab="negocio">Sobre mi negocio</button>
                            </li>
                        </ul>
                        <div class="card-body">
                            <!-- Contenido -->
                            <div class="tab-content">
                                <div class="tab-pane show" id="inventario">
                                    Contenido del inventario
                                </div>
                                <div class="tab-pane" id="ventas">
                                    Contenido de ventas
                                </div>
                                <div class="tab-pane" id="resumen">
                                    Contenido de resumen
                                </div>
                                <div class="tab-pane" id="negocio">
                                    Contenido sobre mi negocio
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const buttons = document.querySelectorAll('[data-tab]');
        const panes = document.querySelectorAll('.tab-pane');

        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Cambiar pestaña activa
                buttons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                // Mostrar contenido correspondiente
                panes.forEach(pane => {
                    if (pane.id === button.dataset.tab) {
                        pane.classList.add('show');
                    } else {
                        pane.classList.remove('show');
                    }
                });
            });
        });
    </script>
@endsection
