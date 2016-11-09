var gCtx = null;
	var gCanvas = null;

	var imageData = null;
	var ii=0;
	var jj=0;
	var c=0;


function dragenter(e) {
  e.stopPropagation();
  e.preventDefault();
}

function dragover(e) {
  e.stopPropagation();
  e.preventDefault();
}
function drop(e) {
  e.stopPropagation();
  e.preventDefault();

  var dt = e.dataTransfer;
  var files = dt.files;

  handleFiles(files);
}

function handleFiles(f)
{
	var o=[];
	for(var i =0;i<f.length;i++)
	{
	  var reader = new FileReader();

      reader.onload = (function(theFile) {
        return function(e) {
          qrcode.decode(e.target.result);
        };
      })(f[i]);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f[i]);	}
}
//読み込んだ後のコールバック
function read(a)
{

	var txt = a;
	var judge = false;
	$('#checkvote').val(0);	// 正しいQRコードが入力されたかのflag用

	try{
		var obj = JSON.parse(txt);

		if ('voter_id' in obj && 'voter_name' in obj) {
			console.log("QRcode_true");
			judge = true;
		}
	} catch(e) {
		console.log("QRcode_false");
		judge = false;
	}

	if (judge === true) {

		// 引数"a"はQRコードで読み込んだ時の内容で文字コードが"SJIS"である。文字コードを変換する際に文字列を配列にする必要がある
		var str2array = function (str) {
			var array = [], i, il=str.length;
			for (i=0; i<il; i++) array.push(str.charCodeAt(i));
			return array;
		};

		// SJISをUTF8に変換する
		var array = str2array(txt),
				utf8_array = Encoding.convert(array, "UNICODE", "SJIS"),
				txt = Encoding.codeToString(utf8_array);

		var obj = JSON.parse(txt);
		var stringid = obj.voter_id.toString();
		var stringname = obj.voter_name.toString();


		alert("ID:"+stringid+", Name"+stringname+"を読み込みました。");

		$('#checkvote').val(1);	//正しいQRコードがセットされたときに"1"を送る
		$('#voterid').val(txt);	//QRコードの内容をinputタグのhiddenに入力する
		$('#YourID').empty();
		$('#YourID').append("<p>ID:"+stringid+"</p>");
		$('#YourID').append("<p>Name:"+stringname+"</p>");
	}
	else {
		alert("読み込みError");
		$('#YourID').empty();
		$('#YourID').append("<p>読み込みError</p>");
	}



}

function load(src)
{
	initCanvas(640,480);
	qrcode.callback = read;
	qrcode.decode(src);
}

function initCanvas(ww,hh){
  gCanvas = document.getElementById("qr-canvas");
  gCanvas.addEventListener("dragenter", dragenter, false);
  gCanvas.addEventListener("dragover", dragover, false);
  gCanvas.addEventListener("drop", drop, false);
  var w = ww;
  var h = hh;
  gCanvas.style.width = w + "px";
  gCanvas.style.height = h + "px";
  gCanvas.width = w;
  gCanvas.height = h;
  gCtx = gCanvas.getContext("2d");
  gCtx.clearRect(0, 0, w, h);
  imageData = gCtx.getImageData( 0,0,320,240);
}

function passLine(stringPixels) {
  //a = (intVal >> 24) & 0xff;

  var coll = stringPixels.split("-");

  for(var i=0;i<320;i++) {
	var intVal = parseInt(coll[i]);
	r = (intVal >> 16) & 0xff;
	g = (intVal >> 8) & 0xff;
	b = (intVal ) & 0xff;
	imageData.data[c+0]=r;
    imageData.data[c+1]=g;
	imageData.data[c+2]=b;
    imageData.data[c+3]=255;
    c+=4;
  }

      if(c>=320*240*4) {
		c=0;
        gCtx.putImageData(imageData, 0,0);
      }
  }
  function captureToCanvas() {
	flash = document.getElementById("embedflash");
	flash.ccCapture();
	qrcode.decode();
  }
