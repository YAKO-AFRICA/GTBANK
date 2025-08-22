<div class="modal fade" id="resulSimul" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <style>
        .ribbon {
        position: absolute;
        /* top: -10px; */
        left: 50%;
        transform: translateX(-50%);
        padding: 5px;
        font-size: 0.85rem;
        font-weight: bold;
        background: #28a745;
        color: white;
        width: 150px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    </style>
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center><h5 class="mb-1">Simulation de Capital</h5></center>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p><strong>Âge :</strong> <span id="modalAge" class="text-primary fs-5"></span></p>
                <p><strong>Date de naissance :</strong> <span id="modalDateNaissance" class="text-secondary fs-5"></span></p>
                
                <div class="position-relative d-inline-block mt-3">
                    <div class="ribbon bg-success text-white text-center">Capital Garanti</div>
                    <div class="border border-success rounded p-3 mt-4 shadow-sm">
                        <h4 class="fw-bold text-success mb-0">
                            <span id="modalCapital"></span>
                        </h4>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success px-4 ">
                    <a href="{{ route('prod.stepProduct') }}" class="text-decoration-none">Annuler la saisie</a>
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuer la saisie</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var myModal = new bootstrap.Modal(document.getElementById("resulSimul"), {
            backdrop: "static",
            keyboard: false
        });
    });
</script>

