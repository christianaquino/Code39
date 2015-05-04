# Code39
PHP class for Code39 barcode creation 

# Basic Usage

```PHP
<?php

include 'Code39/code39.php';

$code39 = new Code39('ABC 123');
$code39->generateBarcode();
```

# More options

## setText
You can provide the barcode text via class constructor or using the setText method.
Valid chars are: A-Z, 0-9, whitespace and -.$/+%

```PHP
$code39->setText('OTHER TEXT');
```

## setBarcodeSize
Set barcode size. Default value: 40

```PHP
$code39->setBarcodeSize(50);
```

## setDisplayText
Set TRUE if you want to display the text below the barcode

```PHP
$code39 = new Code39('ABC 123');
$code39->setDiaplayText(true);
$code39->generateBarcode();
```
In this example the image will include \*ABC 123\* below the barcode

## setFontFilePath
Default .ttf font file is placed into the same folder than code39.php file, if you want to move them to another folder or just use another TrueType font file, you must provide the full path to the file via setFontFilePath method. 

```PHP
$code39->setDiaplayText('/full/path/to/true/type/font/file.ttf');
```

## setFileName
If you want to save the image, just use the setFileName method to provide the full path to the generated image. If you provide only a file name, image will be saved in the same folder than code39.php file.

```PHP
$fileName = 'IMG_' . time() . '.png';

// Image will be saved in the same folder than code39.php file 
$code39->setFileName($fileName);

// Image will be saved in /Users/myuser/Images/
$code39->setFileName('/Users/myuser/Images/' . $fileName);
```

## setTextFontSize
Sets the text font size to be displayed below the barcode.
Valid values are in range from 1 to 5. Default value is 3
