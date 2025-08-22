<div class="modal fade" id="addProductReseau{{ $item->id }}" tabindex="-1" aria-labelledby="membreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="membreModalLabell">Attribuer un produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('setting.store.product.by.reseau') }}" method="POST" class="submitForm">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <fieldset class="border p-3">
                            <legend class="float-none w-auto px-2"><small><h5 class="mb-4">Produits commercialisé</h5></small></legend>


                            <input type="text" name="codereseau" id="codereseau" value="{{ $item->id }}" class="form-control" hidden>
                                <div class="mb-4">
                                    <label class="form-label" for="codeproduit">Code Produit:</label>
                                    <select name="codeproduit" class="form-select" id="codeproduit" required>
                                        <option value="">-- Choisir une option --</option>
                                        @foreach ($products as $item)
                                            <option class="form-select" value="{{ $item->CodeProduit }}" data-code-value="{{ $item->CodeProduit }}">{{ $item->MonLibelle }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="form-label" for="codeproduitformule">Code Produit Formule:</label>
                                    <select name="codeproduitformule" class="form-select" id="codeproduitformule">
                                        <option value="">-- Choisir une option --</option>
                                    </select>
                                </div>
                        </fieldset>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Femer</button>
                    <button type="submit" class="btn btn-success">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>

</div>