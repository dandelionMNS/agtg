<!DOCTYPE html>
<html>

<head>
    <title>Invoice for order: {{$order->id}}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            padding: 0;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            margin: 0;
            padding: 5px 0;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .order-table th,
        .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .order-table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        .total-price {
            text-align: right;
            font-size: 1.2em;
            margin-top: 20px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>Invoice for order: {{$order->id}}</h2>
    </div>

    <!-- User details -->
    <div class="details">
        <p><strong>Name:</strong> {{$user->name}}</p>
        <p><strong>Email:</strong> {{$user->email}}</p>
        <p><strong>Address:</strong> {{$user->address}}</p>
        <p><strong>Phone No:</strong> {{$user->phone_no}}</p>
    </div>

    <!-- Order items -->
    <table class="order-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Product Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order_items as $index => $item)
                <tr>
                    <td>{{$index + 1}}.</td>
                    <td>{{$item->prod_title}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price_per_item}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-price">
        <strong>Total Price:</strong> RM {{$order->total_price}}
    </div>
</body>

</html>