<section class="belanja" id="belanja">
    <h2 class="fw-bold fs-1 ff-popins text-dark"><span>Pergi</span> Belanja</h2>
    <p class="text-dark">"Belanja praktis, harga ekonomis! Semua kebutuhan anda ada di sini!"</p>
    <div class="row justify-content-center my-4">
        <div class="col-md-6">
            {{-- Form ini mengirim data dengan method GET ke rute saat ini --}}
            <form action="{{ route('home') }}#belanja" method="GET">
                <div class="input-group">
                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Cari nama produk..."
                        value="{{ $search ?? '' }}"
                    >
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>
    <div class="roq">
        @foreach ($products as $product)
            <div class="belanja-card col-lg-24p mb-4 " style="flex: 0 0 20%; max-width: 20%;">
                <a href="{{ route('product-detail', $product->id) }}" class="text-decoration-none text-dark">
                    <div class="p-2" style="cursor: pointer;">
                        @if($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                                 class="belanja-card-img">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                        <p class="belanja-card-title w-75 text-truncate">- {{ $product->name }} -</p>
                        <p class="belanja-card-price">IDR {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </a>

            </div>
        @endforeach

    </div>

</section>
