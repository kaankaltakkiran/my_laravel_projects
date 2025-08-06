<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;

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

        // Barkod oluşturucuları
        $dns1d = new DNS1D();
        $dns2d = new DNS2D();

        // Her ürün için SVG barkod oluştur (C39 tipi, yeterli margin ile)
        foreach ($products as &$product) {
            // C39 barkod tipi, genişlik: 1, yükseklik: 40, renk: siyah, SVG: true
            $product['barcode_svg'] = $dns1d->getBarcodeHTML($product['barcode'], 'C39', 1, 40, 'black', true);
        }

        // 2. sayfa için farklı barkod tipleri (renkli)
        $barcodeTypes = [
            [
                'name' => 'Code 128',
                'type' => 'C128',
                'barcode' => 'Laravel-PDF-Demo',
                'color' => 'black',
                'is_2d' => false,
            ],
            [
                'name' => 'EAN-13',
                'type' => 'EAN13',
                'barcode' => '1234567890128',
                'color' => '#45B7D1',
                'is_2d' => false,
            ],
            [
                'name' => 'QR Code',
                'type' => 'QRCODE,L',
                'barcode' => 'Laravel PDF Barcode Demo',
                'color' => 'black',
                'is_2d' => true,
            ],
        ];

        // Barkod tiplerini SVG olarak oluştur
        foreach ($barcodeTypes as &$barcodeType) {
            if ($barcodeType['is_2d']) {
                $barcodeType['barcode_svg'] = $dns2d->getBarcodeHTML(
                    $barcodeType['barcode'],
                    $barcodeType['type'],
                    4,
                    4,
                    $barcodeType['color'],
                    true
                );
            } else {
                $barcodeType['barcode_svg'] = $dns1d->getBarcodeHTML(
                    $barcodeType['barcode'],
                    $barcodeType['type'],
                    2,
                    60,
                    $barcodeType['color'],
                    true
                );
            }
        }

        // PDF view'ını oluştur
        $pdf = Pdf::loadView('product-table', compact('products', 'barcodeTypes'));

        // PDF boyutunu ayarla (portrait başlangıç)
        $pdf->setPaper('A4', 'portrait');

        // Eğer download parametresi varsa indir, yoksa görüntüle
        if ($request->has('download')) {
            return $pdf->download('urun-listesi-barkodlu.pdf');
        } else {
            return $pdf->stream('urun-listesi-barkodlu.pdf');
        }
    }
}
