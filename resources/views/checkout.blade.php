@extends('layouts.app2')

@section('title', 'Carts-Detail')

@section('content')
    <body class="ps-5 pe-5" style="margin-top: 15vh;">
    <div class="ps-5 pe-5">
        <h3 class="ps-3 ff-popins fw-bolder">Keranjang</h3>
        <div class="d-flex p-3">
            <div class="container ff-popins" style="width: 68%;">
                <div class=" bg-white rounded-3 p-3 my-3">
                    <div class=" d-flex">
                        <input type="checkbox" id="pilih_semua" name="pilih_semua" class="styled-checkbox">
                        <label class="ms-3 fw-bold ff-popins" for="defaultCheck1">
                            Pilih semua
                        </label>
                    </div>
                </div>
                <div class="bg-white rounded-3 p-3">
                    <div class="d-flex">
                        <input type="checkbox" id="pilih_semua" name="pilih_semua" class="styled-checkbox">
                        <img style="width: 25vh" src="" alt="">
                        <p style="width: 75vh">Nama Product</p>
                        <div class="align-items-center">
                            <p class="fw-bold ff-popins">Rp100.000</p>
                            <div class="input-group input-group-sm" style="width: 90px;">
                                <button class="btn btn-outline-secondary" type="button" id="minus-btn">-</button>

                                <input type="text" class="form-control text-center" value="2" id="quantity-input"
                                       readonly>

                                <button class="btn btn-outline-secondary" type="button" id="plus-btn">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container bg-white rounded-3 ff-popins p-3 my-3" style="width: 30%;">
                <h6 class="fw-bold">Ringkasan Belanja</h6>
                <div class="d-flex">
                    <p class="text-secondary" style="width: 36vh">Total</p>
                    <p class="fw-bold">Rp 200.000</p>
                </div>
                <hr>
                <div class="d-grid">
                <button href="" class="btn-custom fw-bold ff-popins rounded-3" type="button" style="height: 5vh">Beli</button>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script>
        const minusBtn = document.getElementById('minus-btn');
        const plusBtn = document.getElementById('plus-btn');
        const quantityInput = document.getElementById('quantity-input');

        plusBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            currentValue++;
            quantityInput.value = currentValue;
        });

        minusBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                currentValue--;
                quantityInput.value = currentValue;
            }
        });
    </script>
@endsection
