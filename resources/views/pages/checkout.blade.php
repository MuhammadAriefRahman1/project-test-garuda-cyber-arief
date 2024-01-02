@extends('layout.base')

@section('content')
    <div class="main-wrapper">
        <h1>Checkout</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>Rp {{ number_format($product->sub_total) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf

            <div class="input-group ">
                <input type="text" name="voucher" class="form-control" placeholder="Kode Voucher" id="voucher-field">
                <button class="btn btn-primary" type="button" id="check-voucher">Cek Voucher</button>
            </div>

            <input type="hidden" name="total_price" value="{{ $total_price }}">
            <div class="d-flex justify-content-end mt-4">
                <h4>
                    <span>Total: </span>
                    <span id="nominal-normal">Rp {{ $total_price }}</span>
                    <span id="nominal-discount" style="display: none"></span>
                </h4>
            </div>

            <div class="d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            var price = {{ $total_price }};

            $('#check-voucher').on('click', async function() {
                let voucher = $('#voucher-field').val();

                let formData = new FormData();

                formData.append('_token', "{{ csrf_token() }}");
                formData.append('voucher', voucher);

                const response = await fetch("/api/voucher/check", {
                    method: "POST",
                    body: formData,
                })

                const data = await response.json();

                if (data?.status != 200) {
                    alert(data?.message ?? "Terjadi kesalahan");
                } else {
                    alert(data?.message ?? "Berhasil");


                    // Add strikethrough to nominal-normal
                    $('#nominal-normal').addClass('text-decoration-line-through');



                    if (data?.data?.type == "percent") {
                        // Calculate discount
                        let discount = price * data?.data?.jumlah;
                        $('#nominal-discount').text(`Rp ${price - discount}`);
                    } else {

                        $('#nominal-discount').text(`Rp ${price - data?.data?.jumlah}`);
                    }

                    $('#nominal-discount').show();
                }


            });
        });
    </script>
@endpush
