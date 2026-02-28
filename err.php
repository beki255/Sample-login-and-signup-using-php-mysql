<?php
if(count($err)>0):?>
<div class="error">
    <?php foreach($err as $error):?>
    <p><?php echo $error?></p>
    <?php endforeach?>
</div>
<?php endif ?>