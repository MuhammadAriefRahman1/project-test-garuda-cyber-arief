<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function check(Request $request)
    {

        $voucher = Voucher::where('code', $request->voucher)->first();

        if (!$voucher) {
            return response()->json([
                "message" => "Voucher tidak ditemukan",
                "status" => 404
            ], 404);
        }

        if ($voucher->expired_at < now()) {
            return response()->json([
                "message" => "Voucher sudah kadaluarsa",
                "status" => 410
            ], 410);
        }

        if ($voucher->status == "used") {
            return response()->json([
                "message" => "Voucher telah digunakan",
                "status" => 409
            ], 409);
        }

        return response()->json([
            "message" => "Voucher ditemukan",
            "status" => 200,
            "data" => [
                "type" => $voucher->type,
                "jumlah" => $voucher->amount,
            ]
        ]);
    }
}
