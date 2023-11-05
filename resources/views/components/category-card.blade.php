<div class="col-lg-4 mt-5 mb-4">
    <div class="d-flex flex-column align-items-center rounded-2 position-relative tarjeta">
        <div class="img-container position-absolute bottom-50" style="max-width: 200px;">
            <img src="{{ asset($image) }}" alt="{{ $alt }}" title="{{ $title }}" class="img-fluid tarjeta-img">
        </div>
        <div class="text-center rounded-2 pt-5 pb-4 w-100 tarjeta-descripcion">
            <h3 class="mb-4 mt-5 pt-5">{{ $title }}</h3>
            <a href="#" class="btn btn-th-info text-white rounded-0">Comprar</a>
        </div>
    </div>
</div>
