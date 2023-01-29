<?php /* Smarty version 2.6.33, created on 2023-01-28 15:28:49
         compiled from C:/xampp/htdocs/kwara-erm/templates/prescription/general_lookup.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'headerTemplate', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_lookup.html', 14, false),array('function', 'html_options', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_lookup.html', 36, false),array('function', 'xlt', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_lookup.html', 39, false),array('function', 'xla', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_lookup.html', 49, false),array('modifier', 'text', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_lookup.html', 44, false),array('modifier', 'attr', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_lookup.html', 51, false),)), $this); ?>
<!DOCTYPE html>
<html>
<head>

<?php echo smarty_function_headerTemplate(array(), $this);?>


<script>
<?php echo '
		function my_process () {
			// Pass the variable
'; ?>

	let rxText = document.lookup.drug[document.lookup.drug.selectedIndex].text;
    let rxcode = (rxText.split('(RxCUI:').pop().split(')')[0]).trim();
	parent.my_process_lookup(document.lookup.drug.value, rxcode);
<?php echo '
		}
'; ?>

</script>
</head>
<body onload="javascript:document.lookup.drug.focus();">
<div class="container-responsive">
<div style="width:100%;height:100%;border:0;" class="drug_lookup" id="newlistitem">
	<form class="form-inline" NAME="lookup" ACTION="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
" METHOD="POST" onsubmit="return top.restoreSession()" style="margin:0px">

	<?php if ($this->_tpl_vars['drug_options']): ?>
        <div>
        <?php echo smarty_function_html_options(array('name' => 'drug','class' => "form-control",'values' => $this->_tpl_vars['drug_values'],'options' => $this->_tpl_vars['drug_options']), $this);?>
<br/>
        </div>
        <div>
            <a href="javascript:;" onClick="my_process(); return true;"><?php echo smarty_function_xlt(array('t' => 'Select'), $this);?>
</a> |
            <a href="javascript:;" class="button" onClick="parent.cancelParlookup();"><?php echo smarty_function_xlt(array('t' => 'Cancel'), $this);?>
</a> |
            <a href="<?php echo $this->_tpl_vars['CONTROLLER_THIS']; ?>
" onclick="top.restoreSession()"><?php echo smarty_function_xlt(array('t' => 'New Search'), $this);?>
</a>
        </div>
	<?php else: ?>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['NO_RESULTS'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>


		<input TYPE="HIDDEN" NAME="varname" VALUE=""/>
		<input TYPE="HIDDEN" NAME="formname" VALUE=""/>
		<input TYPE="HIDDEN" NAME="submitname" VALUE=""/>
		<input TYPE="HIDDEN" NAME="action" VALUE="<?php echo smarty_function_xla(array('t' => 'Search'), $this);?>
">
		<div ALIGN="CENTER" CLASS="infobox">
			<input class="form-control" TYPE="TEXT" NAME="drug" VALUE="<?php echo ((is_array($_tmp=$this->_tpl_vars['drug'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"/>
			<input TYPE="SUBMIT" NAME="action" VALUE="<?php echo smarty_function_xla(array('t' => 'Search'), $this);?>
" class="button"/>
			<input TYPE="BUTTON" VALUE="<?php echo smarty_function_xla(array('t' => 'Cancel'), $this);?>
" class="button" onClick="parent.cancelParlookup();"/>
		</div>
		<input type="hidden" name="process" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PROCESS'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />

	<?php endif; ?></form>
	</div>
</div>
</body>
</html>