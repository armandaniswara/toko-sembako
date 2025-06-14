<section class="belanja" id="belanja">
    <h2 class="fw-bold fs-1 ff-popins text-dark"><span>Pergi</span> Belanja</h2>
    <p class="text-dark">"Belanja praktis, harga ekonomis! Semua kebutuhan anda ada di sini!"</p>
    <div class="roq">
        @foreach ($products as $product)
            <div class="belanja-card col-lg-24p mb-4 " style="flex: 0 0 20%; max-width: 20%;">
                <a href="{{ route('product-detail', $product->id) }}" class="text-decoration-none text-dark">
                    <div class="p-2" style="cursor: pointer;">
                        @if($product->image)
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="belanja-card-img">
                        @else
                            <span class="text-muted">No image</span>
                        @endif
                        <p class="belanja-card-title w-75 text-truncate">- {{ $product->name }} -</p>
                        <p class="belanja-card-price">IDR {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </a>
{{--                <button href="/payment" class="my-2 btn-custom ff-poppins rounded-3 text-light w-50" style="height: 5vh; text-decoration: none;">Beli</button>--}}
                <a type="submit" href="/payment" class="my-2 btn ff-popins w-50" style="background-color: #b98a55; color: white;">
                    Beli
                </a>
            </div>
        @endforeach

    </div>
{{--    @push('scripts')--}}
{{--        <script>--}}
{{--            document.addEventListener('DOMContentLoaded', function () {--}}
{{--                const minusButton = document.getElementById('button-minus');--}}
{{--                const plusButton = document.getElementById('button-plus');--}}
{{--                const numberInput = document.querySelector('.input-group input[type="number"]');--}}

{{--                minusButton.addEventListener('click', function () {--}}
{{--                    let currentValue = parseInt(numberInput.value);--}}
{{--                    if (currentValue > parseInt(numberInput.min)) {--}}
{{--                        numberInput.value = currentValue - 1;--}}
{{--                    }--}}
{{--                });--}}

{{--                plusButton.addEventListener('click', function () {--}}
{{--                    let currentValue = parseInt(numberInput.value);--}}
{{--                    numberInput.value = currentValue + 1;--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endpush--}}
</section>
