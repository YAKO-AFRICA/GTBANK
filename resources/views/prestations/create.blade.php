@extends('layouts.main')

@section('content')
    <!--start stepper one-->
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Prestations</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Demande de prestation | {{ $typePrestation->libelle ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->

    <div id="stepper1" class="bs-stepper">
        <div class="card">
          
          <div class="card-header">
              <div class="d-lg-flex flex-lg-row align-items-lg-center justify-content-lg-between" role="tablist">
                  <div class="step" data-target="#test-l-1">
                    <div class="step-trigger" role="tab" id="stepper1trigger1" aria-controls="test-l-1">
                      <div class="bs-stepper-circle">1</div>
                      <div class="">
                          <h5 class="mb-0 steper-title">Information personnelle</h5>
                          <p class="mb-0 steper-sub-title">Entrez vos coordonnées</p>
                      </div>
                    </div>
                  </div>
                  <div class="bs-stepper-line"></div>
                  <div class="step" data-target="#test-l-2">
                      <div class="step-trigger" role="tab" id="stepper1trigger2" aria-controls="test-l-2">
                        <div class="bs-stepper-circle">2</div>
                        <div class="">
                            <h5 class="mb-0 steper-title">Information sur prestation</h5>
                            <p class="mb-0 steper-sub-title">Entrer les Information liée à la prestation</p>
                        </div>
                      </div>
                    </div>
                  <div class="bs-stepper-line"></div>
                  <div class="step" data-target="#test-l-3">
                      <div class="step-trigger" role="tab" id="stepper1trigger3" aria-controls="test-l-3">
                        <div class="bs-stepper-circle">3</div>
                        <div class="">
                            <h5 class="mb-0 steper-title">Finalisation de la demande</h5>
                            <p class="mb-0 steper-sub-title">Finaliser votre demande</p>
                        </div>
                      </div>
                    </div>
                    
                </div>
          </div>
          <div class="card-body">
          
            <div class="bs-stepper-content">
              <form action="{{ route('prestation.store')}}" method="POST" enctype="multipart/form-data" class="submitForm">
                @csrf
                @include('prestations.components.steps.stepInfosPerso')
                
                @include('prestations.components.steps.stepInfosPrest')

                @include('prestations.components.steps.stepDoc')
              </form>
            </div>
             
          </div>
         </div>
       </div>
      <!--end stepper one-->

      <script>
        document.querySelector('form').addEventListener('submit', function (event) {
            event.preventDefault(); // Empêcher le rechargement par défaut du formulaire

            let formData = new FormData(this);

            fetch(this.action, {
                method: this.method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.type === 'success') {
                    // Ouvrir le PDF dans un nouvel onglet
                    window.open(data.urlback, '_blank');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Erreur système. Veuillez réessayer.');
            });
        });
      </script>
@endsection
