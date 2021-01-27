<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<p>Xin chào <span style="font-size: 20px; color:blue">{{ $name }}</span></p>
	<h5>Bạn vừa đặt hàng thành công trên DHTshop</h5>
	<table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Màu</th>
                <th>Đơn giá (VNĐ)</th>
                <th>Số lượng</th>
                <th>Tổng (VNĐ)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order_detail as $order_detail)
            <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$order_detail->name}}</td>
                <td>{{$order_detail->color}}</td>
                <td>{{number_format($order_detail->unit_price)}}</td>
                <td>{{$order_detail->quantity}}</td>
                <td>{{number_format($order_detail->unit_price*$order_detail->quantity)}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="9">
                    <div class="pull-right">
                        <p>Tổng tiền: <span class="text-danger pull-right ml-2">{{number_format($order->total_price)}} VNĐ</span></p>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
	<p>Vui lòng kiểm tra lịch sử đơn hàng để cập nhật thêm chi tiết</p>
	<br>
	<p>Thân ái</p>
</body>
</html>
