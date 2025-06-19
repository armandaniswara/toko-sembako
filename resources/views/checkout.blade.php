@extends('layouts.app2')

@section('title', 'Carts-Detail')

@section('content')
    <body class="ps-5 pe-5" style="margin-top: 15vh;">
    <div class="ps-5 pe-5">
    <h3 class="ps-3 ff-popins fw-bolder">Checkout</h3>
    <div class="d-flex p-3">
        <div class="container ff-popins" style="width: 68%;">
            <div class=" bg-white rounded-3 p-3 my-3">
                <h6 class="fw-bolder">Alamat Pengiriman</h6>
                <div class="d-flex">
                <i class="fa-solid fa-location-dot my-1 me-2"></i>
                <p>{{$userAlamat}}</p>
                </div>
            </div>
            <div class="bg-white rounded-3 p-3">
                <h6 class="fw-bolder">Produk</h6>
                <table class="table align-middle">
                    <tbody>
                    @forelse ($checkouts as $checkout)
                        <tr>
                            <td style="width: 3%;">
                                @if ($checkout_type === 'cart')
                                    <input type="checkbox" class="styled-checkbox" name="cart_selected[]" value="{{ $checkout->id }}">
                                @endif
                            </td>
                            <td style="width: 15%;">
                                @if($checkout->product->image)
                                    <img style="width: 75px; height: auto;" src="{{ asset('storage/products/' . $checkout->product->image) }}" alt="{{ $checkout->product->name }}">
                                @else
                                    <img style="width: 75px; height: auto;" src="" alt="No image">
                                @endif
                            </td>
                            <td style="width: 40%;">{{ $checkout->product->name }}</td>
                            <td style="width: 15%;" class="fw-bold ff-popins">Rp{{ number_format($checkout->product->price , 2, ',', '.') }}</td>
                            <td style="width: 27%;">
                                <div class="input-group input-group-sm ms-5" style="width: 90px">
                                    @if ($checkout_type === 'cart')
                                    <button class="btn btn-outline-secondary minus-btn" type="button" data-cart-id="{{ $checkout->id }}">-</button>
                                    <input type="text" class="form-control text-center quantity-input"
                                           id="quantity-input{{ $checkout->id }}" value="{{ $checkout->qty }}" readonly>
                                    <button class="btn btn-outline-secondary plus-btn" type="button" data-cart-id="{{ $checkout->id }}">+</button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-secondary">keranjang kosong</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="container bg-white rounded-3 ff-popins p-3 my-3" style="width: 30%;">
            <h6 class="fw-bold" >Metode Pembayaran</h6>
            <div class="d-flex">
                <p class="text-secondary" style="width: 36vh">Total</p>
                <p id="total-harga" class="fw-bold">Rp 0</p>
            </div>
        </div>
    </div>
    </div>
    </body>

    <script>
        const plusButtons = document.querySelectorAll('.plus-btn');
        const minusButtons = document.querySelectorAll('.minus-btn');

        function updateQuantityOnServer(cartId, qty) {
            fetch("{{ route('cart.updateQuantity') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ cart_id: cartId, qty: qty })
            })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        console.log('Quantity updated');
                    } else {
                        alert('Gagal update quantity');
                    }
                })
                .catch(() => alert('Error pada saat update quantity'));
        }

        plusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const cartId = this.getAttribute('data-cart-id');
                const input = document.getElementById('quantity-input' + cartId);
                let currentValue = parseInt(input.value);
                currentValue++;
                input.value = currentValue;
                updateQuantityOnServer(cartId, currentValue);
                updateTotal();
            });
        });

        minusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const cartId = this.getAttribute('data-cart-id');
                const input = document.getElementById('quantity-input' + cartId);
                let currentValue = parseInt(input.value);
                if (currentValue > 1) {
                    currentValue--;
                    input.value = currentValue;
                    updateQuantityOnServer(cartId, currentValue);
                    updateTotal();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const checkboxes = document.querySelectorAll('input[name="cart_selected[]"]');
            const selectAllCheckbox = document.getElementById('pilih_semua');
            const totalElement = document.getElementById('total-harga'); // target untuk total harga

            function formatToRupiah(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }).format(amount);
            }

            function getPriceFromString(priceString) {
                return parseFloat(
                    priceString
                        .replace(/[^0-9,]/g, '')
                        .replace(',', '.')
                );
            }

            function updateTotal() {
                let total = 0;
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        const row = checkbox.closest('tr');
                        const priceText = row.querySelector('td.fw-bold').textContent.trim();
                        const qtyInput = row.querySelector('.quantity-input');
                        const qty = Number(qtyInput.value);
                        const price = getPriceFromString(priceText);
                        total += price * qty;
                    }
                });

                // Ubah tampilannya ke format 'Rp xxx.xxx'
                totalElement.textContent = formatToRupiah(total);


            }

            // Event checkbox item
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', () => {
                    updateTotal();

                    // Kalau semua checkbox item dicentang, centang juga checkbox pilih_semua
                    const allChecked = [...checkboxes].every(cb => cb.checked);
                    selectAllCheckbox.checked = allChecked;
                });
            });

            // Event checkbox pilih_semua
            selectAllCheckbox.addEventListener('change', () => {
                const checked = selectAllCheckbox.checked;
                checkboxes.forEach(cb => cb.checked = checked);
                updateTotal();
            });

            // Inisialisasi total harga saat halaman dimuat
            updateTotal();
        });
    </script>

@endsection
