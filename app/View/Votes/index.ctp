<h2>Download Vote Data</h2>
<?php
    echo $this->Form->create('Vote', array('action' => 'fileDownload'));
    echo $this->Form->hidden('voteinfo', array('value' => $revoteinfo));
    if(count($files) > 0){
?>
<table class="table">
    <thead>
        <tr>
            <th>Uploaded Date</th>
            <th>Day</th>
            <th>Ballot Machine ID</th>
            <th>Selection</th>
        </tr>
    </thead>
    <tbody>
<?php
    foreach($files as $file){
        echo "<tr>";
            echo "<td>".$file["datetime"]."</td>";
            echo "<td>".$file["event_day"]."</td>";
            echo "<td>".$file["mac_addr"]."</td>";
            echo "<td>";
            echo $this->Form->input(
                ' ', array(
                    'type' => 'checkbox',
                    'value' => $file["filename"],
                    'label' => false,
                    'class' => 'form-check-input',
                    'id' => $file["filename"],
                    'hiddenField' => false,
                    'style' => 'margin-top: -5px;'
                )
            );
            echo "</td>";
        echo "</tr>";
    }
?>
    </tbody>
</table>
<?php
    echo $this->Form->submit('Download Vote Result', array('class'=>'btn btn-custom'));
} else {
    echo "<h4>ダウンロードするファイルがありません</h4>";
}
?>
<style>
.input.checkbox{
    margin-left: 20px;
}
</style>
