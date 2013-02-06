<?php if (!defined('THINK_PATH')) exit();?>
<table class="tableForm" border=1>
<?php if(is_array($info1)): $i = 0; $__LIST__ = $info1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr><td width="15%"><?php echo ($key); ?></td><td><?php echo ($v); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; ?>
</table>