@extends('layout.base')

@section('content')
    <div class="main-wrapper">
        <h1>Selamat Datang di Aplikasi Kasir Sederhana!</h1>

        <div class="mt-4">
            <form action="{{ route('transaction.checkout') }}" method="POST">
                @csrf
                <ul class="list-group">
                    @foreach ($products as $product)
                        <li class="list-group-item">
                            <div class="d-flex">
                                <img src="{{ asset('assets/images/'.$product->image) }}" alt="Gambar {{ $product->name }}">
                                <div class="ms-4 d-flex flex-column justify-content-center">
                                    <h5>{{ $product->name }}</h5>
                                    <span>Rp {{ number_format($product->price) }}</span>
                                    <div class="input-container">
                                        <button type="button" class="btn btn-primary button-decrement">-</button>
                                        <input type="number" name="products[{{ $product->id }}]" class="form-control input-quantity" value="0">
                                        <button type="button" class="btn btn-primary button-increment">+</button>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex  mt-4">
                    <button type="submit" class="btn btn-primary w-100">Checkout</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function () {
            $('.button-increment').on('click', function () {
                let inputQuantity = $(this).parent().find('.input-quantity');
                let quantity = parseInt(inputQuantity.val());
                inputQuantity.val(quantity + 1);
            });

            $('.button-decrement').on('click', function () {
                let inputQuantity = $(this).parent().find('.input-quantity');
                let quantity = parseInt(inputQuantity.val());
                if (quantity > 0) {
                    inputQuantity.val(quantity - 1);
                }
            });
        });
    </script>
@endpush
