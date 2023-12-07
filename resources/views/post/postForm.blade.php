@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>New Post</h2>
        <form action="{{ route('linkedin.store') }}" method="post" id="cta">
            @csrf

            <div class="form-group">
                <label for="title">Tittle:</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="platform">Plataform:</label>
                <select name="platform" class="form-control" required>
                    <option value="LinkedIn">LinkedIn</option>
                    <option value="Reddit">Reddit</option>
                    <option value="Twitter/X">Twitter/X</option>
                </select>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea name="content" class="form-control" required></textarea>
            </div>

            <div class="form-group" id="textRedditGroup" style="display: none;">
                <label for="text_reddit">Text for Reddit:</label>
                <textarea name="text_reddit" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control" required>
                    <option value="Post">Post</option>
                    <option value="Queue">Add to queue</option>
                </select>
            </div>

            <div class="form-group" id="dateSelect" style="display: none;">
                <label for="scheduled_date">Schedule Date:</label>
                <input type="date" name="scheduled_date" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Post</button>
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

        document.addEventListener('DOMContentLoaded', function() {
            var statusSelect = document.querySelector('select[name="status"]');
            var dateSelect = document.getElementById('dateSelect');

            statusSelect.addEventListener('change', function() {
                if (this.value === 'Post') {
                    dateSelect.style.display = 'none';
                } else {
                    dateSelect.style.display = 'block';
                }
            });
        });
    </script>
@endsection