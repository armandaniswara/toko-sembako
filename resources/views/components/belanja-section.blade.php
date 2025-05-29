<section class="belanja" id="belanja">
    <h2 class="fw-bold fs-1 ff-popins text-dark"><span>Pergi</span> Belanja</h2>
    <p class="text-dark">"Belanja praktis, harga ekonomis! Semua kebutuhan anda ada di sini!"</p>
    <div class="roq">
        @foreach ($products as $product)
            <div class="belanja-card col-lg-24p mb-4 " style="flex: 0 0 20%; max-width: 20%;">
                @if($product->image)
                    <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                         class="belanja-card-img">
                @else
                    <span class="text-muted">No image</span>
                @endif
                <p class="belanja-card-title w-100">- {{ $product->name }} -</p>
                <p class="belanja-card-price">IDR {{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="input-group ms-4" style="width: 80%">
                    <button class="btn btn-outline-secondary" type="button" id="button-minus">-</button>
                    <input type="number" class="form-control text-center" value="1" min="0" aria-label="Jumlah">
                    <button class="btn btn-outline-secondary" type="button" id="button-plus">+</button>
                </div>
                <button class="my-2 btn ff-popins w-50" style="background-color: #b98a55; color: white;">Beli</button>
            </div>
        @endforeach

    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const minusButton = document.getElementById('button-minus');
                const plusButton = document.getElementById('button-plus');
                const numberInput = document.querySelector('.input-group input[type="number"]');

                minusButton.addEventListener('click', function () {
                    let currentValue = parseInt(numberInput.value);
                    if (currentValue > parseInt(numberInput.min)) {
                        numberInput.value = currentValue - 1;
                    }
                });

                plusButton.addEventListener('click', function () {
                    let currentValue = parseInt(numberInput.value);
                    numberInput.value = currentValue + 1;
                });
            });
        </script>
    @endpush
</section>
