$(document).on('change', '#upfile',function () {

    if (this.files.length > 0) {
        // 選択されたファイル情報を取得
        var file = this.files[0];

        // readerのresultプロパティに、データURLとしてエンコードされたファイルデータを格納
        var reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = function(){
            load(reader.result);
            console.log(reader.result);
        }
    }
});
