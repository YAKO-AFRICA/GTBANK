@extends('layouts.main')

@section('content')
<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Prestations</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('shared.home')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Mes prestations demandes</li>
            </ol>
        </nav>
    </div>
    </div>
<!--end breadcrumb-->
	<div class="card">
        {{-- <div class="card-header d-flex justify-content-center align-items-center ">
            <div class="w-75 mb-3">
                <form id="contractPrest-form" method="post">
                    @csrf
                    <label class="mb-3">Sélectionner un contrat pour voir ses prestations</label>
                    <select name="idcontratPrest" id="idcontratPrest" class="form-select">
                        <option selected>Veuillez sélectionner un contrat</option>
                        @foreach(Auth::guard('customer')->user()->membre->membreContrat as $contrat)
                            <option value="{{$contrat->idcontrat}}">{{$contrat->idcontrat}}</option>
                        @endforeach
                    </select>
                </form>                                
            </div>
        </div> --}}
		<div class="card-body container-fluid">
			<div class="table-responsive">
                <table id="example2" class="table mes-prestations table-striped table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Code de la demande</th>
                            <th>#ID du contrat</th>
                            <th>Type de prestation</th>
                            <th>Telephone associé</th>
                            <th>Email associé</th>
                            <th>Montant souhaité</th>
                            <th>Etape</th>
                            <th>Date de demande</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prestations as $prestation)
                            <tr>
                                <td>{{ $prestation->code }}</td>
                                <td>{{ $prestation->idcontrat }}</td>
                                <td>{{ $prestation->typeprestation }}</td>
                                <td>{{ $prestation->cel }}</td>
                                <td>{{ $prestation->email }}</td>
                                <td>{{ $prestation->montantSouhaite }}</td>
                                <td>
                                    @if($prestation->etape == 1)
                                        <div class="badge rounded-pill text-danger bg-light-danger p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>En attente
                                        </div>
                                    @elseif($prestation->etape == 2)
                                        <div class="badge rounded-pill text-warning bg-light-warning p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>En cours
                                        </div>
                                    @elseif($prestation->etape == 3)
                                        <div class="badge rounded-pill text-success bg-light-success p-2 text-uppercase px-3">
                                            <i class="bx bxs-circle me-1"></i>Terminé
                                        </div>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $prestation->created_at->format('d/m/Y à H:i') }}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="{{ route('prestation.show', $prestation->code) }}" class="ms-2 border"><i class='bx bxs-show'></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
		</div>
	</div>
@endsection