@extends('layout.base')

@section('content')
    <div class="main-wrapper">
        <h1>Transaksi Disimpan!</h1>

        <table>
            <tbody>
                <tr>
                    <th scope="row">Subtotal</th>
                    <td>:</td>
                    <td>Rp {{ number_format($transaction->subtotal ?? '-') }}</td>
                </tr>
                <tr>
                    <th scope="row">Setelah Diskon</th>
                    <td>:</td>
                    <td>Rp {{ number_format($transaction->subtotal_after_discount ?? $transaction->subtotal) ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        @isset($voucher)
            <div class="alert alert-info mt-2">
                <h4 class="alert-heading">Horee</h4>
                <div>
                    Transaksi yang diatas Rp 2.000.000 akan mendapatkan voucher diskon Rp 10.000
                </div>
            </div>
            <div class="alert alert-info mt-2">
                <div>
                    Kode: <strong>{{ $voucher->code ?? '-' }}</strong>
                </div>
            </div>
        @endisset

        <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('home') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
@endsection
