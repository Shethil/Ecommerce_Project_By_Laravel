@foreach ($order_details as $order)
    <div>INVOICE TO:</div>
    <h2>{{ $order->billing->name }}</h2>

    <div>Address:</div>
    <h2>{{ $order->billing->address }}</h2>

    <div>Phone Number:</div>
    <h2>{{ $order->billing->phone_number }}</h2>

    <div>Email:</div>
    <h2>{{ $order->billing->email }}</h2>

    <div>Date of Invoice</div>
    <h2>{{ $order->created_at->format('d/m/Y') }}</h2>

    <div>Due Date</div>
    <h2>{{ $order->created_at->format('d/m/Y') }}</h2>

    <table>
        <thead>
            <tr>
                <th>SI</th>
                <th class="text-left">Description</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderdetails as $item)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td class="text-left">{{ $item->product->name }}</td>
                    <td>{{ $item->product_qty }}</td>
                    <td>${{ $item->product_price }}</td>
                    <td>${{ $item->product_qty * $item->product_price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <tfoot>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">Discount({{ $order->coupon_name }})</td>
            <td>-$({{ $order->discount_amount }})</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">Suntotal</td>
            <td>-$({{ $order->total }})</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2">Grand Total</td>
            <td>-$({{ $order->total }})</td>
        </tr>
    </tfoot>
@endforeach
