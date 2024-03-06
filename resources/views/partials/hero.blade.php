<!--hero-->
<div class="container-fluid bg-striped hero p-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 d-flex flex-column justify-content-start align-items-start p-5">
                <h3 class="new-product text-start text-secondary">
                    Featured Product
                </h3>
                <h2 class="text-light product-title text-lg-start my-3 text-uppercase">{{ $heroProduct->name }}</h2>
                <p class="description h5 text-light text-start fs-5">
                    {{ $heroProduct->long_desc }}
                </p>
                <a class="btn btn-th-primary text-white rounded-0 mt-4 p-3" href="{{ route('product.show',$heroProduct->id) }}">Buy Now</a>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                <img src="{{ asset($heroProduct->images[0]->url) }}" alt="Random Hero Product"
                     style="width: 100%; max-height: 100%; object-fit: contain;">
            </div>
        </div>
    </div>
</div>
<!--end hero-->
