<!DOCTYPE html>
<html>
<head>
    <link
        href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAACAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAERERAQARABAQAAEAAAARARARAQEQEQEBEBEBAAAAAAEQAAEBEBAQABEREQEQEAEQAAAAAAAAABAAEBABAREQEAEQEQAAAAEBAAAAABAAAAAREREBEBERERAAAQEAEAABEBEBABAQEQEQEQEBABARARAAAQEAEAABERERAAARERECzQAAe/IAAEpKAABL/gAAelcAAAJZAAD//QAA1oUAAJP6AAD/fwAAAkAAAHreAABLUgAAStIAAHreAAADwAAA"
        rel="icon" type="image/x-icon"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>QR Code Tests</title>
    <style>
        body{
            background: lightblue;
        }
    </style>
</head>
<body>
<?php
// https://github.com/chillerlan/php-qrcode
// https://www.twilio.com/blog/create-qr-code-in-php

// https://qr-platba.cz/pro-vyvojare/specifikace-formatu/
// https://www.cnb.cz/cs/platebni-styk/iban/iban-mezinarodni-format-cisla-uctu/
// https://www.cnb.cz/export/sites/cnb/cs/platebni-styk/.galleries/pravni_predpisy/download/vyhl_169_2011.pdf

use chillerlan\QRCode\{QRCode, QROptions};
require_once __DIR__ . '/./vendor/autoload.php';

use App\QR\Image\QRImageWithLogo;
use App\QR\Options\LogoOptions;


$options = new LogoOptions(
  [
    'eccLevel' => QRCode::ECC_H,
    'imageBase64' => true,
    'logoSpaceHeight' => 17,
    'logoSpaceWidth' => 17,
    'scale' => 20,
    'version' => 7,
  ]
);

$data = 'SPD*1.0*ACC:CZ2806000000000168540115*AM:450.00*CC:CZK*MSG:PLATBA ZA ZBOZI*X-VS:1234567890';

$qrOutputInterface = new QRImageWithLogo(
  $options,
  (new QRCode($options))->getMatrix($data)
);

$qrcode = $qrOutputInterface->dump(
  null,
  __DIR__.'/./public/img/hermanec.png'
);
printf('<img src="%s" alt="QR Code" width="400" height="400"/>', $qrcode);
?>


</body>
</html>
