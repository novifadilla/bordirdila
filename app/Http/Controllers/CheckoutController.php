<?php

namespace App\Http\Controllers;

use App\Checkout;
use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartProducts = Cart::Content();

        $user = DB::table('users')
        ->where('id', session('user')->id)
        ->first(); 
        return view('checkout.index', ['cartProducts' => $cartProducts, 'user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (Cart::Content()->count() != null) {
            // $orderId = DB::table('orders')
            //     ->insertGetId(['id'=> session('user')->id]);

            $cartProducts = Cart::content();
            date_default_timezone_set("Asia/Bangkok");
            $tgl = date('y-m-d');
            $data = array();
            $rdm = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZqwertyuiopasdfghjklzxcvbnm'), 1, 8);
            $det = date('dmYHis');
            $aidi = $det . $rdm;
            $jenis= $request->metode;
            $totalPrice = 0;
            $params = array();
            foreach ($cartProducts as $cp) {
                $totalPrice+=($cp->subtotal);
                $params[] = [
                    'productId' => $cp->id,
                    'idPemesanan' => $aidi,
                    'productName' => $cp->name,
                    'price' => $cp->price,
                    'quantity' => $cp->qty,
                    'size' => $cp->options->size,
                    'tanggal' => $tgl,
                    'totalPrice' => $cp->subtotal,
                    'jenis'=>$jenis,
                    'namaCustomer' => session('user')->username,
                    // 'jenis'->$request->metode

                ];

                Cart::remove($cp->rowId);

                // Cart::remove($cp->rowId);
            }
            
            DB::table('orders')->insert($params);

            return view('checkout.thanks');
        } else {
            $cartProducts = Cart::content();
            return view('cart.index', ['cartProducts' => $cartProducts]);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
