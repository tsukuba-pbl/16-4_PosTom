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
echo $this->Form->submit('Create', array('class'=>'btn btn-custom'));
?>
<style>
.input.checkbox{
    margin-left: 20px;
}
</style>
