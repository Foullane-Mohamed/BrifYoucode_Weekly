@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Annonces</h2>
    <a href="{{ route('annonce.create') }}" class="btn btn-primary mb-3">Ajouter une Annonce</a>
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Catégorie</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($annonces as $annonce)
                <tr>
                    <td>{{ $annonce->id }}</td>
                    <td>{{ $annonce->titre }}</td>
                    <td>{{ Str::limit($annonce->description, 50) }}</td>
                    <td>{{ $annonce->prix }}</td>
                    <td>{{ $annonce->categorie->name }}</td>
                    <td>{{ $annonce->status }}</td>
                    <td>
                        <a href="{{ route('annonce.show', $annonce->id) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('annonce.edit', $annonce->id) }}" class="btn btn-success">Éditer</a>
                        <form action="{{ route('annonce.destroy', $annonce->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $annonces->links() }}
</div>
@endsection
