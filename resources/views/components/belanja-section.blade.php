(resources/views/shop/index.blade.php)
<section class="belanja" id="belanja">
    <h2 class="fw-bold fs-1 ff-popins text-dark"><span>Pergi</span> Belanja</h2>
    <p class="text-dark">"Belanja praktis, harga ekonomis! Semua kebutuhan anda ada di sini!"</p>
    <div class="roq">
        @foreach ($products as $product)
            <div class="belanja-card">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="belanja-card-img">
                <h3 class="belanja-card-title">- {{ $product->name }} -</h3>
                <p class="belanja-card-price">IDR {{ number_format($product->price, 0, ',', '.') }}</p>
            </div>
        @endforeach
    </div>
</section>
