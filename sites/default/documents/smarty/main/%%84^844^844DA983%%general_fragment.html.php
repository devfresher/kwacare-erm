<?php /* Smarty version 2.6.33, created on 2023-01-28 15:27:16
         compiled from C:/xampp/htdocs/kwara-erm/templates/prescription/general_fragment.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'xlt', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_fragment.html', 13, false),array('modifier', 'text', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_fragment.html', 30, false),)), $this); ?>
<?php if (empty ( $this->_tpl_vars['prescriptions'] )): ?>
<?php echo smarty_function_xlt(array('t' => 'None'), $this);?>

<?php else: ?>
<div class="table-responsive">
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th><?php echo smarty_function_xlt(array('t' => 'Drug'), $this);?>
</th>
                <th><?php echo smarty_function_xlt(array('t' => 'Details'), $this);?>
</th>
                <th><?php echo smarty_function_xlt(array('t' => 'Qty'), $this);?>
</th>
                <th><?php echo smarty_function_xlt(array('t' => 'Refills'), $this);?>
</th>
                <th><?php echo smarty_function_xlt(array('t' => 'Filled'), $this);?>
</th>
            </tr>
        </thead>
        <tbody>
            <?php $_from = $this->_tpl_vars['prescriptions']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prescription']):
?>
            <?php if ($this->_tpl_vars['prescription']->get_active() > 0): ?>
            <tr>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->drug)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_size())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_unit_display())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_dosage_display())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_quantity())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_refills())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</td>
                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_date_added())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</td>
            </tr>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </tbody>
    </table>
</div>
<?php endif; ?>