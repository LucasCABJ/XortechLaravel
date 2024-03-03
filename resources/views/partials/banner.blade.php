<article class="row">
    <div class="col-12 p-0 overflow-hidden" style="background-color: #7d62a0;">
        <div class="container-fluid">
            <div class="row p-5 position-relative parlante__container">
                <div class="parlante__circulo"
                     style="max-height: 500px; height: 500px; max-width: 500px; width: 500px;"></div>
                <div class="parlante__circulo"
                     style="max-height:500px; height: 350px; max-width: 350px; width: 350px;"></div>
                <div class="parlante__circulo"
                     style="max-height: 1000px; max-width: 1000px; height: 1000px; width: 1000px"></div>
                <div class="parlante__circulo"
                     style="max-height: 500px; height: 500px; max-width: 500px; width: 500px;"></div>
                <div class="parlante__circulo"
                     style="max-height: 750px; height: 750px; max-width: 750px; width: 750px;"></div>
                <div class="col-lg-6 position-relative">
                    <img src="{{ asset($bannerProduct->images[0]->url) }}" class="img-fluid speaker__img"
                         alt="Random Banner Product">
                </div>
                <div class="col-lg-6 text-white p-5 d-flex flex-column justify-content-center align-items-start">
                    <h3 class="h1 text-uppercase">{{ $bannerProduct->Name }}</h3>
                    <p class="fs-5">{{ $bannerProduct->long_desc }}</p>
                    <a href="{{ route('product.show',$bannerProduct->id) }}" class="btn btn-outline-light rounded-0 p-3">View Product</a>
                </div>
            </div>
        </div>
    </div>
</article>
