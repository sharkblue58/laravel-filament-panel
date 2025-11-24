<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $record->id }}</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            color: #333; 
            margin: 0;
            padding: 20px;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #eee;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .totals {
            max-width: 300px;
            float: right;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        {{-- Header --}}
        <div class="header">
            <div>
                <h1 style="margin: 0; font-size: 28px; color: #222;">INVOICE</h1>
                <p style="margin: 5px 0; font-size: 14px;">Invoice #: <strong>{{ $record->id }}</strong></p>
                <p style="margin: 5px 0; font-size: 14px;">Date: <strong>{{ $record->created_at->format('Y-m-d') }}</strong></p>
            </div>

            {{-- Customer Info --}}
            <div style="text-align: right;">
                <p style="margin: 0; font-size: 16px; font-weight: bold;">{{ $record->customer_name }}</p>
                <p style="margin: 2px 0; font-size: 14px;">{{ $record->customer_email }}</p>
                @if ($record->billing_address)
                    <p style="margin: 2px 0; font-size: 14px;">Billing: {{ $record->billing_address }}</p>
                @endif
                @if ($record->shipping_address)
                    <p style="margin: 2px 0; font-size: 14px;">Shipping: {{ $record->shipping_address }}</p>
                @endif
            </div>
        </div>

        {{-- Items Table --}}
        <table>
            <thead>
                <tr>
                    <th style="text-align: left;">Product</th>
                    <th style="text-align: center;">Qty</th>
                    <th style="text-align: right;">Price</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($record->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td style="text-align: center;">{{ $item->quantity }}</td>
                        <td style="text-align: right;">{{ number_format($item->price, 2) }}</td>
                        <td style="text-align: right;">{{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Totals --}}
        <div class="totals">
            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                <span>Tax:</span>
                <span>0.00</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                <span>Shipping:</span>
                <span>0.00</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-weight: bold; border-top: 1px solid #333; padding-top: 5px;">
                <span>Total:</span>
                <span>{{ number_format($record->total, 2) }}</span>
            </div>
        </div>

        <div style="clear: both;"></div>

        {{-- Footer --}}
        <div class="footer">
            <p>Thank you for your purchase!</p>
        </div>
    </div>
</body>
</html>