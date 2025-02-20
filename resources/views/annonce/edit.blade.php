@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Éditer l'Annonce</h2>
    <form action="{{ route('annonce.update', $annonce->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ $annonce->titre }}" required>
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control" required>{{ $annonce->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Prix</label>
            <input type="number" name="prix" class="form-control" value="{{ $annonce->prix }}">
        </div>
        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            @if($annonce->image)
                <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->titre }}" class="img-fluid mt-3">
            @endif
        </div>
        <div class="mb-3">
            <label>Catégorie</label>
            <select name="categorie_id" class="form-control" required>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $annonce->categorie_id == $categorie->id ? 'selected' : '' }}>
                        {{ $categorie->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="actif" {{ $annonce->status == 'actif' ? 'selected' : '' }}>Actif</option>
                <option value="brouillon" {{ $annonce->status == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                <option value="archivé" {{ $annonce->status == 'archivé' ? 'selected' : '' }}>Archivé</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
