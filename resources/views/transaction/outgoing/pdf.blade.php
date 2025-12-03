<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #111827; 
            padding: 20px;
        }

        h2 {
            font-size: 20px;
            margin-bottom: 8px;
            font-weight: 700;
            color: #1f2937; 
        }

        p, li {
            font-size: 13px;
        }

        ul {
            margin: 0 0 10px 0;
            padding-left: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 18px;
        }

        th {
            background: #f3f4f6; 
            font-weight: 600;
            padding: 8px 10px;
            border: 1px solid #d1d5db; 
            text-align: left;
            font-size: 13px;
        }

        td {
            padding: 8px 10px;
            border: 1px solid #d1d5db;
            font-size: 12.8px;
        }

        tbody tr:nth-child(even) {
            background: #f9fafb; 
        }

        .filter-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb; 
            padding: 10px 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>

<h2>{{ $title }}</h2>

@if ($keyword)
    <div class="filter-box">
        <p style="margin: 0 0 6px 0;"><strong>Keyword: </strong>{{$keyword}}</p>
    </div>
@endif

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Produk</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
            <th>Tanggal</th>
            <th>Catatan</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($outgoing as $item)
            <tr>
                <td>{{ ++$loop->index }}</td>
                <td>{{ $item->incoming->customer->name}}</td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp {{ number_format($item->product->price_buy, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                <td> {{ \Carbon\Carbon::parse($item->date)->locale('id')->isoFormat('D MMMM YYYY') }}</td>
                <td>{{ $item->outgoing->notes }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8" style="text-align:center; padding:12px; font-weight:600;">
                    Tidak ada data
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
