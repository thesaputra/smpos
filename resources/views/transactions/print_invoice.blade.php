<title>{{$invoice}}</title>
<span style="font-weight:bold">Glory Laundry</span>
<address>
Lobby Kolam Renang, Tower B.No B2<br>
Apartement Jarrdin Cihampelas<br>
022-91323820, 0857 9444 0447
</address>
<span>---------------------------------------------</span>
<br/>
<span style="font-size:12px">No.{{$invoice}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:12px">Order: {{ date('d-m-Y', strtotime($data['transaction']->date_order))}}</span><br/>
<span style="font-size:12px">Nama: {{$data['transaction']->name}}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:12px">Selesai: {{ date('d-m-Y', strtotime($data['transaction']->date_deliver))}}</span><br/>
<br/>
<table style="font-size:12px" width="36%">
<thead>
<tr>
  <th align="left">Layanan</th>
  <th>#</th>
  <th>Harga</th>
  <th>Total</th>
</tr>
</thead>
<tbody>
  <?php $tem = 0; $subtotal = 0; ?>
  @foreach($data['detail_transaction'] as $key => $value)
	<tr>
    <td>{{ ($value->package_type == 1 ) ? 'Reg'.'-'.$value->name : 'Exp'.'-'.$value->name }}</td>
    <td>{{$value->qty}}</td>
    <td>{{ ($value->package_type == 1 ) ? number_format($value->price_regular, 2, ',', '.').'/'.$value->unit :  number_format($value->price_express, 2, ',', '.').'/'.$value->unit }}</td>
    <td>{{ ($value->package_type == 1 ) ? number_format($value->price_regular*$value->qty, 2, ',', '.') :  number_format($value->price_express*$value->qty, 2, ',', '.') }}</td>
  </tr>
  <?php
  if ($value->package_type == 1)
  {
    $subtotal += $value->price_regular*$value->qty;
  } else {
    $subtotal += $value->price_express*$value->qty;
  }
  ?>
  @endforeach
</tbody>
</table>
<span>---------------------------------------------</span>
<table style="font-size:12px" width="34%">
<tbody>
  <tr>
    <td colspan="2"></td>
    <td align="right">SubTotal:</td>
    <td align="right">{{number_format($subtotal, 2, ',', '.')}}</td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td align="right">Diskon:</td>
    <td align="right">{{number_format($data['transaction']->discount, 2, ',', '.')}}</td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td align="right">Total Bayar:</td>
    <td align="right">{{number_format($sum_amount, 2, ',', '.')}}</td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td align="right">Sisa Bayar:</td>
    <td align="right">{{number_format($subtotal - $sum_amount - $data['transaction']->discount, 2, ',', '.')}}</td>
  </tr>
</tbody>
</table>
<span>---------------------------------------------</span><br/>
<span style="font-size:18px; font-weight:bold">Terima kasih!</span><br/>
<span style="font-size:12px">Ketentuan:</span><br/>
<span style="font-size:10px width:100px; display:block">Maksimal pengambilan barang dilakukan 1 bulan dari tgl
  <br/>selesai, jika pengambilan dilakukan lebih dari 1 bulan
  <br/>maka barang Anda diluar dari tanggung jawab kami.
</span>
<br/>
<span style="font-size:10px">Glory Laundry - Laundry Management<span>
<style>
address {
  display: block;
  font-style: normal;
  font-size: 11px;
}
</style>
