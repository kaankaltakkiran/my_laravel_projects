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
        
        /* Page break styles */
        .page-break {
            page-break-before: always;
        }
        
        /* Horizontal page styles */
 
        
        .barcode-showcase {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            width: 100%;
            max-width: 900px;
            margin: 20px auto;
        }
        
        .barcode-item {
            text-align: center;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .barcode-item h3 {
            margin: 0 0 15px 0;
            color: #333;
            font-size: 16px;
            font-weight: bold;
        }
        
        .barcode-display {
            margin: 15px 0;
            min-height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .barcode-code {
            font-size: 12px;
            color: #666;
            margin-top: 10px;
            font-family: monospace;
        }
        
        /* Full barcode page styles */
        .full-barcode-page {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        
        .full-barcode-container {
            padding: 40px;
            border: 3px solid #007bff;
            border-radius: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .full-barcode-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .full-barcode-display {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin: 20px 0;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .full-barcode-number {
            font-size: 18px;
            margin-top: 20px;
            font-family: monospace;
            letter-spacing: 2px;
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

    <!-- 2. SAYFA - HORIZONTAL BARCODE SHOWCASE -->
    <div class="page-break">
        <div class="header">
            <h1 style="color: #007bff; margin-bottom: 10px;">BARKOD TİPLERİ VİTRİNİ</h1>
            <p style="color: #666; font-size: 14px; margin-bottom: 30px;">Farklı Barkod Formatları ve Renkleri</p>
        </div>
        
        <div class="barcode-showcase">
            @foreach($barcodeTypes as $barcodeType)
            <div class="barcode-item">
                <h3>{{ $barcodeType['name'] }}</h3>
                <div class="barcode-display">
                    {!! $barcodeType['barcode_svg'] !!}
                </div>
                <div class="barcode-code">{{ $barcodeType['barcode'] }}</div>
            </div>
            @endforeach
        </div>

           <div class="footer">
        <p>Bu rapor otomatik olarak {{ date('d.m.Y H:i:s') }} tarihinde oluşturulmuştur.</p>
        <p>Toplam {{ count($barcodeTypes) }} barkod tipi listelenmektedir.</p>
    </div>
    </div>
</body>
</html>
