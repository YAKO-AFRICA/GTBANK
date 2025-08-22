<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Basic modal</button> --}}
<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $typePrestation->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card radius-10">
                    <div class="card-body bg-light-success rounded">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('root/images/login-images/yvon.png')}}" class="rounded-circle p-1 border" width="90" height="90" alt="...">
                            <div class="flex-grow-1 ms-3 text-dark">
                                <h5 class="mt-0">Qu'est ce qu'un(e) {{$typePrestation->libelle ?? ''}}</h5>
                                <p class="mb-0">{!! ($typePrestation->description) ?? 'Pas de description' !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($typePrestation->impact == 0)
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                    <a href="{{ route('prestation.create', $typePrestation->id) }}" type="button" class="btn btn-primary">Ok, Je Continue</a>
                </div>
            @elseif($typePrestation->impact == 1)
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Fermer</button>
                    <a href="{{ route('rdv.create', $typePrestation->id) }}" type="button" class="btn btn-primary">Ok, Je Continue</a>
                </div>
            @endif
        </div>
    </div>
</div>