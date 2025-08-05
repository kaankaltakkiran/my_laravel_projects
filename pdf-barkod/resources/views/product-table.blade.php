<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ürün Listesi - Barkodlu</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 20px;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 15px;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .laravel-logo {
            width: 100px;
            height: auto;
            margin: 0 auto;
        }
        
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 24px;
        }
        
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 12px;
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            table-layout: fixed;
        }
        
        .products-table th {
            background-color: #007bff;
            color: white;
            padding: 12px 8px;
            text-align: center;
            font-weight: bold;
            border: 1px solid #0056b3;
        }
        
        .products-table td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            vertical-align: middle;
            text-align: center;
        }
        
        .products-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        .products-table tr:hover {
            background-color: #e3f2fd;
        }
        
        .product-name {
            font-weight: bold;
            color: #007bff;
            font-size: 14px;
        }
        
        .price {
            color: #28a745;
            font-weight: bold;
            font-size: 14px;
        }
        
        .stock {
            color: #dc3545;
            font-weight: bold;
            text-align: center;
        }
        
        .barcode-cell {
            text-align: center;
            padding: 5px 3px;
            width: 30%;
            max-width: 30%;
            overflow: hidden;
        }
        
       
        .barcode-number {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }
        
        .signature-section {
            margin-top: 20px;
            text-align: right;
            padding: 10px 0;
        }
        
        .signature {
            width: 100px;
            height: auto;
            border-bottom: 1px solid #333;
            padding-bottom: 3px;
            margin-bottom: 3px;
        }
        
        .signature-label {
            font-size: 10px;
            color: #666;
            margin-top: 3px;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <div style="text-align: center; margin-bottom: 15px;">
                <img src="{{ public_path('images/Laravel-Logo.wine.png') }}" alt="Laravel Logo" style="width: 80px; height: auto; margin-right: 15px; vertical-align: middle;">
                <span style="font-size: 24px; font-weight: bold; color: #333; vertical-align: middle;">Laravel</span>
            </div>
        </div>
        <h1>ÜRÜN LİSTESİ</h1>
        <p>Barkodlu Ürün Tablosu - {{ date('d.m.Y H:i') }}</p>
    </div>

    <table class="products-table">
        <thead>
            <tr>
                <th style="width: 8%;">#</th>
                <th style="width: 32%;">Ürün Adı</th>
                <th style="width: 18%;">Fiyat (₺)</th>
                <th style="width: 12%;">Stok</th>
                <th style="width: 30%;">Barkod</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td style="text-align: center; font-weight: bold;">{{ $index + 1 }}</td>
                <td class="product-name">{{ $product['name'] }}</td>
                <td class="price">{{ number_format($product['price'], 0, ',', '.') }} ₺</td>
                <td class="stock">{{ $product['stock'] }} adet</td>
                <td class="barcode-cell">
                    <div class="barcode-wrapper">
                        {!! $product['barcode_svg'] !!}
                    </div>
                    <div class="barcode-number">{{ $product['barcode'] }}</div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- İmza Bölümü -->
    <div class="signature-section">
        <img src="{{ public_path('images/signature.svg') }}" alt="İmza" class="signature">
        <div class="signature-label">Yetkili İmza</div>
    </div>

    <div class="footer">
        <p>Bu rapor otomatik olarak {{ date('d.m.Y H:i:s') }} tarihinde oluşturulmuştur.</p>
        <p>Toplam {{ count($products) }} ürün listelenmektedir.</p>
    </div>
</body>
</html>
