<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <meta http-equiv="X-UA-Compatible" content="ie=edge"> --}}
    <title>Đơn hàng</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    {{-- <link href="" rel="stylesheet" type="text/css" /> --}}
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 10px;
        }
        .text-uppercase{
            font-size: 20px !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <p><img src="{{url('public')}}/uploads/logos/{{$config_home->logo}}" alt="" width="100px"></p>
        <h5>DHTShop.com</h5>
        <p>Địa chỉ: {{$config_home->address}}</p>
        <p>Số điện thoại: {{$config_home->phone}}</p>

        {{-- {{ date('d m Y', strtotime($note->created_at)) }} --}}
        <p class="text-center text-uppercase font-weight-bold">Hóa đơn bán  hàng</p>
        <p class="font-weight-bold"> Ngày bán: <span class="font-weight-normal">{{date('d/m/Y', strtotime($order->created_at))}}</span> </p>
        <p class="font-weight-bold"> Khách hàng: <span class="font-weight-normal">{{$order->name}}</span> </p>
        <p class="font-weight-bold"> Địa chỉ:  <span class="font-weight-normal">{{$order->address}}</span> </p>
        <p class="font-weight-bold"> Số điện thoại: <span class="font-weight-normal">{{$order->phone}}</span> </p>
        <p class="font-weight-bold"> Ghi chú: <span class="font-weight-normal">{{$order->note}}</span> </p>
        <table  class="table ">
            <thead>
              <tr>
                <th scope="col">STT</th>
                <th scope="col">Sản phẩm</th>
                <th scope="col">Màu</th>
                <th scope="col">Đơn giá (VNĐ)</th>
                <th scope="col">Số lượng</th>
                <th scope="col" >Thanh tiền</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($order_detail as $item)
                <tr>
                    <th scope="row">{{$loop->index+1}}</th>
                    <td>{{$item->name}}</td>
                    <td>{{$item->color}}</td>
                    <td>{{number_format($item->unit_price)}}</td>
                    <td>{{$item->quantity}}</td>
                    <td class="text-right">{{number_format($item->unit_price*$item->quantity)}}</td>
                </tr>
                  @endforeach
                  
                  <tr>
                    <td colspan="4" class="text-right">Tổng thanh toán:</td>
                    <td  colspan="2"class="text-right">{{number_format($order->total_price + 20000)}}</td>
                  </tr>
                  
                  <tr>
                    <td colspan="6" >Tổng thanh toán bằng chữ: <span class="font-weight-bold text-capitalize">{{$word}} đồng</span></td>
                  </tr>

            </tbody>
          </table>
          <div class="text-right"></div>
          {{-- <p> Tổng tiên hàng: {{number_format($order->total_price)}} VNĐ</p>
          <p>Phí Ship: {{number_format(20000)}}VND </p>
          <p>Tổng Thu: {{number_format($order->total_price + 20000)}} VNĐ </p> --}}
    </div>

</body>

</html>

