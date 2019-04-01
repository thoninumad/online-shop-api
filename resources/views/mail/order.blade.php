<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <div style="text-align:center">
            <h2>INFORMASI PESANAN PEMBELIAN DI PUSAT INOVASI DAN PENGUJIAN PRODUK OTOMOTIF</h2>
            <h2>LEMBAGA BENGKEL MAHASISWA MESIN ITS</h2>
        </div>

        <hr class="my-3">

        <strong>Pembeli</strong>           : {{$order->user->name}} <br>
        <strong>Order ID</strong>        : {{$order->id}} <br>
        <strong>Invoice Number</strong>  : {{$order->invoice_number}} <br>
        <strong>Tagihan Total</strong>      : Rp. {{number_format($order->total_bill, 2, ",", ".")}} <br>
        <strong>Layanan Kurir</strong> : {{$order->courier_service}} <br>
        <strong>Status Order</strong>    : {{$order->status}} <br>

        <hr class="my-3">

        <h3>Detail Order</h3>
        Products ({{$order->totalQuantity}} items) <br>
        <ul>
            @foreach($order->products as $product)
                <li>{{$product->name}} <b>({{$product->pivot->quantity}} items)</b></li>
            @endforeach
        </ul>

        <hr class="my-3">

        Silahkan lakukan pembayaran ke rekening berikut. <br><br>
        <strong>BNI</strong> : a/n Roze Windu Yuni Syarah (0605280435) <br><br>

        Lakukan konfirmasi pembayaran dengan membalas email ini. <br>
        Pembayaran dan konfirmasinya maksimal 1x24 jam. <br><br>

        Terima kasih. <br><br><br>


        PIPPO LBMM ITS
    </body>
</html>
