<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;

class ProductPdfController extends Controller
{
    public function generateProductPdf(Request $request)
    {
        // 3 adet örnek ürün verisi
        $products = [
            [
                'name' => 'Laptop Dell XPS 13',
                'price' => 25999.99,
                'stock' => 15,
                'barcode' => '1234567890123',
            ],
            [
                'name' => 'iPhone 15 Pro',
                'price' => 45999.99,
                'stock' => 8,
                'barcode' => '2345678901234',
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'price' => 35999.99,
                'stock' => 12,
                'barcode' => '3456789012345',
            ],
        ];

        // Her ürün için SVG barkod oluştur (C39 tipi, yeterli margin ile)
        $dns1d = new DNS1D();
        foreach ($products as &$product) {
            // C39 barkod tipi, genişlik: 1, yükseklik: 40, renk: siyah, SVG: true
            $product['barcode_svg'] = $dns1d->getBarcodeHTML($product['barcode'], 'C39', 1, 40, 'black', true);
        }

        // PDF view'ını oluştur
        $pdf = Pdf::loadView('product-table', compact('products'));

        // PDF boyutunu ayarla
        $pdf->setPaper('A4', 'portrait');

        // Eğer download parametresi varsa indir, yoksa görüntüle
        if ($request->has('download')) {
            return $pdf->download('urun-listesi-barkodlu.pdf');
        } else {
            return $pdf->stream('urun-listesi-barkodlu.pdf');
        }
    }
}
