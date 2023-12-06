@extends('layouts.app')

@section('content')
    @inertia
    <div class="container">
        <h2>Nuevo Post</h2>
        <form action="{{ route('linkedin.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="title">Título:</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="platform">Plataforma:</label>
                <select name="platform" class="form-control" required>
                    <option value="LinkedIn">LinkedIn</option>
                    <option value="Reddit">Reddit</option>
                    <option value="Twitter/X">Twitter/X</option>
                </select>
            </div>

            <div class="form-group">
                <label for="content">Contenido:</label>
                <textarea name="content" class="form-control" required></textarea>
            </div>

            <div class="form-group" id="textRedditGroup" style="display: none;">
                <label for="text_reddit">Texto específico para Reddit:</label>
                <textarea name="text_reddit" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="status">Estado:</label>
                <select name="status" class="form-control" required>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var platformSelect = document.querySelector('select[name="platform"]');
            var textRedditGroup = document.getElementById('textRedditGroup');

            platformSelect.addEventListener('change', function() {
                if (this.value === 'Reddit') {
                    textRedditGroup.style.display = 'block';
                } else {
                    textRedditGroup.style.display = 'none';
                }
            });
        });
    </script>
@endsection