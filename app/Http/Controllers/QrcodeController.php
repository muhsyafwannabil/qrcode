    <?php

    namespace App\Http\Controllers;

    use Endroid\QrCode\Builder\Builder;
    use Endroid\QrCode\Encoding\Encoding;
    use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
    use Endroid\QrCode\Writer\PngWriter;
    use Endroid\QrCode\Color\Color;

    class QRCodeController extends Controller
    {
        public function generate()
        {
            // Data yang akan dimasukkan dalam QR Code
            $data = 'https://example.com';

            // Gunakan Builder untuk Generate QR Code
            $result = Builder::create()
                ->writer(new PngWriter())
                ->data($data)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(new ErrorCorrectionLevelLow())
                ->size(300) // Ukuran QR Code
                ->margin(10) // Margin sekitar QR Code
                ->foregroundColor(new Color(0, 0, 0))
                ->backgroundColor(new Color(255, 255, 255))
                ->build();

            // Return image dengan Content-Type PNG
            return response($result->getString(), 200)
                ->header('Content-Type', $result->getMimeType());
        }
    }
