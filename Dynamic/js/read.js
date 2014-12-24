function read(src){
	var ForReading=1; 
	var fso=new ActiveXObject(Scripting.FileSystemObject); 
	var f=fso.OpenTextFile(src,ForReading); 
	return(f.ReadAll()); 
}