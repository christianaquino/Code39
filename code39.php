<?php
/**
 * This class generates a valid Code39 barcode png image.
 * It require GD 2 lib and Free_3_of_9_Extended_Regular
 * 
 * @see http://en.wikipedia.org/wiki/Code_39
 * @author Christian Aquino <christian.a77@gmail.com>
 * @version 1.0
 */
class Code39 {
	private $fontFilePath; 
        private $fontFileName = 'Free_3_of_9_Extended_Regular.ttf';
	private $barcodeSize = 40;
	private $text = '**';
	private $displayText = false;
	private $image = null;
	private $textFontSize = 3;
	private $filename = null;

	/**
	 * Constructor
	 *
	 * @param string $text
	 */
	function __construct($text){
		$this->setText($text);
                $this->fontFilePath = dirname(__FILE__) . '/' . $this->fontFileName; 
	}

	/**
	 * Only Code39 valid chars (A-Z, 0-9, whitespace and -.$/+%)
	 *
	 * @param string $text
	 */
	public function setText($text){
		$pattern = '^[A-Z0-9 +/% \s\.\$\-]*$';
		if (ereg($pattern,$text)) {
			$this->text = '*' . $text . '*';
		}else {
			die('Only Code39 valid chars (A-Z, 0-9, whitespace and -.$/+%)');
		}
	}

	/**
	 * Sets barcode size
	 *
	 * @param int $size
	 */
	public function setBarcodeSize($size){
		$this->barcodeSize = $size;
	}

	/**
	 * Set it to True if you want to see the text below the barcode image
	 *
	 * @param bool $displayText
	 */
	public function setDisplayText($displayText){
		$this->displayText = $displayText;
	}

	/**
	 * Sets the Free_3_of_9_Extended_Regular font file path.
	 * By default the same dir than this class file
         * 
	 * @param string $fontFile
	 */
	public function setFontFilePath($fontFile){
		$this->fontFilePath = $fontFile;
	}

	/**
	 * Sets output file name
	 *
	 * @param string $filename
	 */
	public function setFileName($filename){
		$this->filename = $filename;
	}

	/**
	 * Sets the text font size to display below the barcode image.
         * Valid values are in range from 1 to 5. Default value is 3
         * 
	 * @param int $textFontSize
	 */
	public function setTextFontSize($textFontSize){
		//setea el tamnio del texto que se muestra debajo del codigo
		if($textFontSize < 0 || $textFontSize > 5 ){
			die("Valid values are in range from 1 to 5");
		}else{
			$this->textFontSize = $textFontSize;
		}
	}

	/**
         * Generates a Code39 barcode image
	 */
	public function generateBarcode(){
		// Sets content-type
		if(empty($this->filename)){
			header("Content-type: image/png");
		}
		//text lenght
		$txtlong = strlen($this->text);
		//create image
		$w = $txtlong * (floor($this->barcodeSize / 2) + 1); //image width
		$h = $this->barcodeSize + 20; //height
		$this->image = imagecreatetruecolor($w,$h);

		//font and background color
                //TODO: create method to set font and background color 
		$backgroudColor = imagecolorallocate($this->image, 255, 255, 255);
		$fontColor  = imagecolorallocate($this->image, 0, 0, 0);
		imagefilledrectangle($this->image, 0, 0, $w-1, $h-1, $backgroudColor);

		imagettftext($this->image, $this->barcodeSize, 0, 2, $this->barcodeSize, 
                        $fontColor, $this->fontFilePath, $this->text);

		if($this->displayText){
			//text position
			$x = round($w/2) - round($txtlong / 2)*(5+$this->textFontSize);
			$y = $this->barcodeSize + 1;
			imageString($this->image,$this->textFontSize,$x,$y,$this->text,$fontColor);
		}
		imagepng($this->image,$this->filename);
	}

	function __destruct(){
		if (isset($this->image)) {
			imagedestroy($this->image);
		}
	}
}
