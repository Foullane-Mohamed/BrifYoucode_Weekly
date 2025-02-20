@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails de l'Annonce</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $annonce->titre }}</h5>
            <p class="card-text">{{ $annonce->description }}</p>
            <p><strong>Prix :</strong> {{ $annonce->prix }}</p>
            @if($annonce->image)
                <img src="{{ asset('storage/' . $annonce->image) }}" alt="{{ $annonce->titre }}" class="img-fluid">
            @endif
            <p><strong>Catégorie :</strong> {{ $annonce->categorie->name }}</p>
            <p><strong>Status :</strong> {{ $annonce->status }}</p>
        </div>
    </div>
    <a href="{{ route('annonce.index') }}" class="btn btn-primary mt-3">Retour</a>
</div>
@endsection
