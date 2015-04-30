# Code39
PHP class for Code39 barcode creation 

# Use

```PHP
<?php

include 'Code39/code39.php';

$code39 = new Code39('COD 39 SAMPLE');
echo $code39->generateBarcode();
```