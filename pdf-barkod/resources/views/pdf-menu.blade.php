<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Barkod Oluşturucu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 90%;
        }
        
        .logo {
            font-size: 48px;
            margin-bottom: 10px;
        }
        
        h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }
        
        .subtitle {
            color: #666;
            margin-bottom: 40px;
            font-size: 16px;
        }
        
        .button-group {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        
        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(245, 87, 108, 0.3);
        }
        
        .features {
            margin-top: 30px;
            text-align: left;
        }
        
        .feature {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            color: #666;
            font-size: 14px;
        }
        
        .feature-icon {
            margin-right: 10px;
            color: #667eea;
            font-size: 16px;
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }
            
            h1 {
                font-size: 24px;
            }
            
            .btn {
                padding: 12px 25px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">📊</div>
        <h1>PDF Barkod Oluşturucu</h1>
        <p class="subtitle">Ürün listesi ve barkodlarını PDF formatında oluşturun</p>
        
        <div class="button-group">
            <a href="{{ route('generate.product.pdf') }}" class="btn btn-primary" target="_blank">
                🔍 PDF'yi Görüntüle
            </a>
            <a href="{{ route('generate.product.pdf', ['download' => 1]) }}" class="btn btn-secondary">
                📥 PDF'yi İndir
            </a>
        </div>
        
        <div class="features">
            <div class="feature">
                <span class="feature-icon">✓</span>
                3 adet örnek ürün ile tablo
            </div>
            <div class="feature">
                <span class="feature-icon">✓</span>
                SVG formatında barkodlar
            </div>
            <div class="feature">
                <span class="feature-icon">✓</span>
                Ürün adı, fiyat ve stok bilgileri
            </div>
            <div class="feature">
                <span class="feature-icon">✓</span>
                Profesyonel PDF tasarımı
            </div>
        </div>
    </div>
</body>
</html>
