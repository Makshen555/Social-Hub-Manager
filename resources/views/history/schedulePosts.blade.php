@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Historial de Posts</h2>
        <div>
            <table>
                <thead style="background-color: #3498db; color: #fff;">
                    <tr>
                        <th style="padding: 10px">
                            ID
                        </th>
                        <th style="padding: 10px">
                            Red Social
                        </th>
                        <th style="padding-inline: 100px; ">
                            Contenido
                        </th>
                        <th style="padding: 10px">
                            Fecha
                        </th>
                        <th style="padding: 10px">
                            Estado
                        </th>
                        <th style="padding: 10px">
                            Fecha Programada
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($posts as $post)
                        <tr style="background-color:  #ecf0f1">
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->platform }}</td>
                            <td>{{ $post->content }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>{{ $post->status }}</td>
                            <td>{{ $post->scheduled_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No hay posts en el historial.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

