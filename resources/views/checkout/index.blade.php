@extends('layouts.user')

@section('content')
<div class="banner-top container-fluid" id="home">
	<div class="container mb-4">
        <div class='row' style='padding-top:25px; padding-bottom:25px;'>
                <div class='col-md-12'>
                    <div id='mainContentWrapper'>
                        <h2 style="text-align: center;">
                        Selesaikan Pesanan
                        </h2>
                        <hr/>
                            <a href="{{route('home.index')}}" class="btn btn-info" style="width: 100%;">Tambah Produk</a>
                        <hr/>
                        <div class="shopping_cart">
                            <form class="form-horizontal" method="post" role="form" id="payment-form">
                            {{csrf_field()}}
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion"
                                                href="#collapseOne">Review
                                                Your Order</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div class="items">
                                                <div class="col-md-9">
                                                    <table class="table table-striped">
                                                        <tr>
                                                            <td>
                                                                <ul>
                                                                    <?php
                                                                		$total=0;
                                                                	?>

                                                                    @foreach($cartProducts as $product)
                                                                    <li>{{$product->name}} ({{$product->qty}})</li>
                                                                    <?php 
												                            $total=$total+($product->subtotal);
												                         ?>
                                                                    @endforeach
                                                                </ul>
                                                            </td>
                                                            <td>
                                                                @foreach($cartProducts as $product)
                                                                <b>Rp.
                                                                    {{number_format($product->price, 2, '.', ',')}}</b>
                                                                <br />
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-md-3">
                                                    <div style="text-align: center;">
                                                        <h3>Order Total</h3>
                                                        <h3><span style="color:green;">Rp. {{$total}}</span></h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <div style="text-align: center; width:100%;">
                                            <input class="btn btn-warning" type="submit" name="submit" value="Confirm">
                                        </div>
                                    </h4>
                                </div>
                            </div>

                    </div>
                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>


@endsection
