<?php
class file
{
	public $file_name;
	public function __construct($file_name){
		$this->file_name = $file_name;
	}
	public function ReadOnechar(){
		/****Ч�� 1 2 3 4 5 6 7 8 9 10*****/
		$fopen = fopen($this->file_name,"r");
		while(false!==($chr = fgetc($fopen))){
			echo $chr;
		}
		fclose($fopen);
	}
	public function ReadOneline(){
		/******��ȡһ�У�д����������******/
		$fopen = fopen($this->file_name,"r");
		echo fgets($fopen);
		fclose($fopen);
	}
	public function ReadAll(){
		/**��ȡ�ļ��������ݣ�����������*///
		return $f_arr = file($this->file_name);
		
	}
	public function Exists(){
		return file_exists($this->file_name);
	}
	public function Delete(){
		if(file_exists($this->file_name))
			unlink($this->file_name);
	}
	public function WriteArray($data){
		$file=fopen($this->file_name,"a+" );
		foreach($data as $value)
		{
			fwrite($file,$value);
			fwrite($file,"\r\n");
		}	
		fclose($file);
	}
	public function WriteChar($value){
		$file=fopen($this->file_name,"a+" );
		fwrite($file,$value);
		fwrite($file,"\r\n");
		fclose($file);
	}
}
?>
<?php
	/*$file = new file("ecg_data.txt");
	print_r($file->ReadAll());
	$file->Delete();
	echo "ok";*/
?>