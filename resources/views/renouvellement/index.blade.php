@extends('layouts.main')
@section('content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"><a href="/shared/home"><i class="bx bx-home-alt"></i></a></div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">Renouvellement</li>
                    <li class="breadcrumb-item active" aria-current="page">Anniversaire du Prêt</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div class="container">
        {{-- <h2 class="mb-4">Liste des prêts en renouvellement</h2> --}}

        <!-- Formulaire de filtre -->
        <form method="GET" action="{{ route('renov.index') }}" class="mb-3">
            <fieldset class="border p-3 rounded">
                <legend class="float-none w-auto px-2">Filtres de recherche</legend>
                
                <div class="row">
                    <!-- Filtre Date de Saisie -->
                    <div class="col-md-4">
                        <fieldset class="border p-2 rounded">
                            <legend class="w-auto px-2">Date de saisie</legend>
                            {{-- <label for="saisiele" class="form-label">Sélectionner une date</label> --}}
                            <input type="date" id="saisiele" name="saisiele" class="form-control" value="{{ request('saisiele') }}">
                        </fieldset>
                    </div>
        
                    <!-- Filtre Jours Restants (Plage Min-Max) -->
                    <div class="col-md-5">
                        <fieldset class="border p-2 rounded">
                            <legend class="w-auto px-2">Jours restants</legend>
                            
                            <div class="row">
                                <div class="col">
                                    {{-- <label for="jours_restants_min" class="form-label">Minimum</label> --}}
                                    <input type="number" id="jours_restants_min" name="jours_restants_min" class="form-control" value="{{ request('jours_restants_min') }}" placeholder="min">
                                </div>
        
                                <div class="col">
                                    {{-- <label for="jours_restants_max" class="form-label">Maximum</label> --}}
                                    <input type="number" id="jours_restants_max" name="jours_restants_max" class="form-control" value="{{ request('jours_restants_max') }}" placeholder="max">
                                </div>
                            </div>
                        </fieldset>
                    </div>
        
                    <!-- Boutons -->
                    <div class="col-md-3 align-self-end text-end row my-auto gy-2">
                        <button type="submit" class="btn btn-primary col-12">Filtrer</button>
                        <a href="{{ route('renov.index') }}" class="btn btn-secondary col-12">Réinitialiser</a>
                    </div>
                </div>
            </fieldset>
        </form>
        
        <!-- Fin du formulaire de filtre -->

        <table class="table mb-0" id="example2">
            <thead class="table-light">
                <tr>
                    <th>Iteraction</th>
                    <th>Adhérent</th>
                    <th>N° Client</th>
                    <th>Email</th>
                    <th>N° Mobiile</th>
                    <th>Date de renouvellement</th>
                    <th>Jours restants</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prets as $pret)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pret->adherent->nom ?? 'N/A' }} {{ $pret->adherent->prenom ?? 'N/A' }}</td>
                        <td>{{ $pret->numeroclient ?? 'N/A' }}</td>
                        <td>{{ $pret->adherent->email ?? 'N/A' }}</td>
                        <td>{{ $pret->adherent->mobile ?? 'N/A' }}</td>
                        <td>{{ $pret->date_renouvellement }}</td>
                        <td class="{{ $pret->jours_restants <= 7 ? 'text-danger' : '' }}">
                            {{ $pret->jours_restants > 0 ? $pret->jours_restants . ' jours restants' : 'Renouvellement dû !' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
