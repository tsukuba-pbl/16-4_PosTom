<h2>Download Vote Data</h2>
<?php
echo $this->Form->create('Download', array('action' => 'fileDownload'));
echo $this->Form->hidden('voteinfo', array('value' => 0));
foreach($files as $file){
    echo $this->Form->input(
        ' ', array(
            'type' => 'checkbox',
            'value' => $file,
            'label' => $file,
            'class' => 'form-check-input',
            'id' => $file,
            'hiddenField' => false
        )
    );
}
if(count($files) > 0){
    echo $this->Form->submit('Download', array('class'=>'btn btn-custom'));
} else {
    echo "<h4>ダウンロードするファイルがありません</h4>";
}
?>
<style>
.input.checkbox{
    margin-left: 20px;
}
</style>
