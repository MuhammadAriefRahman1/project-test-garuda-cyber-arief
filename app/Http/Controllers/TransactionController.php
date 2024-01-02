<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function checkout(Request $request)
    {
        $product_ids = $request->get("products");
        $product_ids_filtered = array_filter($product_ids); // Filter nilai kosong

        if (empty($product_ids_filtered)) {
            return redirect()->back();
        }

        $products = collect($product_ids_filtered)->mapWithKeys(function ($quantity, $product_id) {
            $product = Product::find($product_id);
            $product->quantity = $quantity;
            $product->sub_total = $quantity * $product->price;

            return [$product_id => $product];
        });

        $total_price = $products->sum("sub_total");

        return view("pages.checkout", compact("products", "total_price"));
    }

    public function store(Request $request)
    {

        $transaction = new Transaction;

        $transaction->subtotal = $request->total_price;

        if ($request->voucher != null) {
            $voucher = Voucher::where("code", $request->voucher)->first();

            if ($voucher && $voucher->type == "nominal") {
                $transaction->subtotal_after_discount = $request->total_price - $voucher->amount;
            } else if ($voucher && $voucher->type == "percent") {
                $transaction->subtotal_after_discount = $request->total_price - ($request->total_price * $voucher->amount / 100);
            }

            $voucher->status = "used";
            $voucher->save();

        }

        if ($transaction->subtotal > 2_000_000) {
            $new_voucher = Voucher::create([
                "code" => Str::random(8),
                "expired_at" => now()->addMonths(3),
                "amount" => 10_000,
            ]);
        }

        $transaction->save();

        return view("pages.finish", [
            "transaction" => $transaction,
            "voucher" => $new_voucher ?? null,
        ]);

    }
}
