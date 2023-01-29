<?php /* Smarty version 2.6.33, created on 2023-01-28 15:28:12
         compiled from C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'headerTemplate', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 15, false),array('function', 'xlj', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 81, false),array('function', 'xlt', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 163, false),array('function', 'xl', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 170, false),array('function', 'xla', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 216, false),array('modifier', 'js_escape', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 90, false),array('modifier', 'js_url', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 94, false),array('modifier', 'attr_url', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 168, false),array('modifier', 'text', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 173, false),array('modifier', 'attr', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 214, false),array('modifier', 'oeFormatShortDate', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_list.html', 240, false),)), $this); ?>
<html>
<head>

<?php echo smarty_function_headerTemplate(array('assets' => 'no_textformat|no_dialog'), $this);?>


<?php echo '
<script>

function changeLinkHref(id,addValue,value) {
    var myRegExp = new RegExp(":" + value + ":");
    if (addValue){ //add value to href
        if(document.getElementById(id) !== null)document.getElementById(id).href += \':\' + value + \':\';
    }
    else { //remove value from href
        if(document.getElementById(id) !== null)document.getElementById(id).href = document.getElementById(id).href.replace(myRegExp,\'\');
    }
}

function changeLinkHrefAll(addValue, value) {
    changeLinkHref(\'multiprint\', addValue, value);
    changeLinkHref(\'multiprintcss\', addValue, value);
    changeLinkHref(\'multiprintToFax\', addValue, value);
}


function changeLinkHref_All(id,addValue,value) {
    var myRegExp = new RegExp(":" + value + ":");
    if (addValue){ //add value to href
        if(document.getElementById(id) !== null)document.getElementById(id).href += \':\' + value + \':\';
    }
    else { //remove value from href
        if(document.getElementById(id) !== null)document.getElementById(id).href = document.getElementById(id).href.replace(myRegExp,\'\');
        // TajEmo Work By CB 2012/06/14 02:17:16 PM remove the target change
    //document.getElementById(id).target = \'\';
    }
}

function Check(chk) {
    var len=chk.length;
    if (len==undefined) {chk.checked=true;}
    else {
        //clean the checked id\'s before check all the list again
        var multiprint=document.getElementById(\'multiprint\');
        if(multiprint!==null) {
            multiprint.href = document.getElementById(\'multiprint\').href.substring(0, document.getElementById(\'multiprint\').href.indexOf(\'=\') + 1);
        }

        var multiprintcss=document.getElementById(\'multiprintcss\');
        if(multiprintcss!==null) {
            multiprintcss.href =  document.getElementById(\'multiprintcss\').href.substring(0, document.getElementById(\'multiprintcss\').href.indexOf(\'=\') + 1);
        }

        var multiprintToFax=document.getElementById(\'multiprintToFax\');
        if(multiprintToFax!==null) {
            multiprintToFax.href = document.getElementById(\'multiprintToFax\').href.substring(0, document.getElementById(\'multiprintToFax\').href.indexOf(\'=\') +1);
        }
        for (let pr = 0; pr < chk.length; pr++){
            if($(chk[pr]).parents("tr.inactive").length==0)
                {
                    chk[pr].checked=true;
                    changeLinkHref_All(\'multiprint\',true,chk[pr].value);
                    changeLinkHref_All(\'multiprintcss\',true, chk[pr].value);
                    changeLinkHref_All(\'multiprintToFax\',true, chk[pr].value);
                }
        }
    }
}

function deleteDrug(d) {
    let msg = '; ?>
<?php echo smarty_function_xlj(array('t' => 'Do you really want to delete?'), $this);?>
<?php echo ';
    let choice = confirm(msg);
    if (choice == true) {
        top.restoreSession();
        $.ajax({
                url: "./library/deletedrug.php",
                type: \'POST\',
                data: {
                    drugid: d,
                    csrf_token_form: '; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
<?php echo '
            },
            success: function(data) {
            console.log(data);
            document.location.href = \''; ?>
<?php echo $this->_tpl_vars['GLOBALS']['webroot']; ?>
<?php echo '/controller.php?prescription&list&id=\' + '; ?>
<?php echo ((is_array($_tmp=$_SESSION['pid'])) ? $this->_run_mod_handler('js_url', true, $_tmp) : js_url($_tmp)); ?>
<?php echo ';
        },
        error: function(error) {
            console.log(error)
        },
    });
    }
}

function Uncheck(chk) {
    var len=chk.length;
    if (len==undefined) {chk.checked=false;}
    else {
        for (pr = 0; pr < chk.length; pr++){
            chk[pr].checked=false;
            changeLinkHref_All(\'multiprint\',false,chk[pr].value);
            changeLinkHref_All(\'multiprintcss\',false, chk[pr].value);
            changeLinkHref_All(\'multiprintToFax\',false, chk[pr].value);
        }
    }
}

var CheckForChecks = function(chk) {
    // Checks for any checked boxes, if none are found than an alert is raised and the link is killed
    if (Checking(chk) == false) { return false; }
    return top.restoreSession();
};

function Checking(chk) {
    var len=chk.length;
    var foundone=false;

    if (len==undefined) {
            if (chk.checked == true){
                foundone=true;
            }
    }
    else {
        for (pr = 0; pr < chk.length; pr++){
            if (chk[pr].checked == true) {
                foundone=true;
            }
        }
    }
    if (foundone) {
        return true;
    } else {
        alert('; ?>
<?php echo smarty_function_xlj(array('t' => 'Please select at least one prescription!'), $this);?>
<?php echo ');
        return false;
    }
}

$(function () {
  $(":checkbox:checked").each(function () {
      changeLinkHref(\'multiprint\',this.checked, this.value);
      changeLinkHref(\'multiprintcss\',this.checked, this.value);
      changeLinkHref(\'multiprintToFax\',this.checked, this.value);
  });
});

</script>

'; ?>

</head>
<body id="prescription_list">
    <div class="container-fluid">
        <div class="row">
            <?php if ($this->_tpl_vars['prescriptions']): ?>
            <div class="col-12">
                <h3><?php echo smarty_function_xlt(array('t' => 'List'), $this);?>
</h3>
            </div>
            <div class="col-12 d-flex justify-content-between">
                <div class="btn-group">
                    <?php if ($this->_tpl_vars['GLOBALS']['rx_zend_pdf_template']): ?>
                        <a target="_blank" id="multiprint" href="<?php echo $this->_tpl_vars['GLOBALS']['webroot']; ?>
/<?php echo $this->_tpl_vars['GLOBALS']['baseModDir']; ?>
<?php echo $this->_tpl_vars['GLOBALS']['zendModDir']; ?>
/public/prescription-pdf-template/<?php echo $this->_tpl_vars['GLOBALS']['rx_zend_pdf_action']; ?>
?id=<?php if (! empty ( $this->_tpl_vars['printm'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['printm'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
<?php endif; ?>" onclick="top.restoreSession()" class="btn btn-primary btn-sm"><?php echo smarty_function_xlt(array('t' => 'Download'), $this);?>
 (<?php echo smarty_function_xlt(array('t' => 'PDF'), $this);?>
)</a>
                    <?php else: ?>
                        <a id="multiprint" href="<?php echo $this->_tpl_vars['CONTROLLER']; ?>
prescription&multiprint&id=<?php if (! empty ( $this->_tpl_vars['printm'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['printm'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
<?php endif; ?>" onclick="top.restoreSession()" class="btn btn-primary btn-sm btn-download"><?php echo smarty_function_xlt(array('t' => 'Download'), $this);?>
 (<?php echo smarty_function_xl(array('t' => 'PDF'), $this);?>
)</a>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['GLOBALS']['rx_zend_html_template']): ?>
                        <a target="_blank" id="multiprintcss" href="<?php echo $this->_tpl_vars['GLOBALS']['webroot']; ?>
/<?php echo $this->_tpl_vars['GLOBALS']['baseModDir']; ?>
<?php echo $this->_tpl_vars['GLOBALS']['zendModDir']; ?>
/public/prescription-html-template/<?php echo $this->_tpl_vars['GLOBALS']['rx_zend_html_action']; ?>
?id=<?php if (! empty ( $this->_tpl_vars['printm'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['printm'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
<?php endif; ?>" onclick="top.restoreSession()" class="btn btn-primary btn-sm"><?php echo smarty_function_xl(array('t' => ((is_array($_tmp='View Printable Version')) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp))), $this);?>
 (<?php echo smarty_function_xlt(array('t' => 'HTML'), $this);?>
)</a>
                    <?php else: ?>
                    <!-- TajEmo work by CB 2012/06/14 02:16:32 PM target="_script" opens better -->
                        <a target="_script" id="multiprintcss" href="<?php echo $this->_tpl_vars['CONTROLLER']; ?>
prescription&multiprintcss&id=<?php if (! empty ( $this->_tpl_vars['printm'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['printm'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
<?php endif; ?>" onclick="top.restoreSession()" class="btn btn-primary btn-sm btn-print"><?php echo smarty_function_xlt(array('t' => 'View Printable Version'), $this);?>
 (<?php echo smarty_function_xlt(array('t' => 'HTML'), $this);?>
)</a>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['GLOBALS']['rx_use_fax_template']): ?>
                        <a id="multiprintToFax" href="<?php echo $this->_tpl_vars['CONTROLLER']; ?>
prescription&multiprintfax&id=<?php if (! empty ( $this->_tpl_vars['printm'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['printm'])) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
<?php endif; ?>" onclick="top.restoreSession()" class="btn btn-primary btn-sm btn-download"><?php echo smarty_function_xlt(array('t' => 'Download'), $this);?>
 (<?php echo smarty_function_xlt(array('t' => 'Fax'), $this);?>
)</a>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['CAMOS_FORM'] == true): ?>
                        <a id="four_panel_rx" href="<?php echo $this->_tpl_vars['GLOBALS']['webroot']; ?>
/interface/forms/CAMOS/rx_print.php?sigline=plain" onclick="top.restoreSession()" class="btn btn-primary btn-sm"><?php echo smarty_function_xlt(array('t' => 'View Four Panel'), $this);?>
</a>
                    <?php endif; ?>
                </div>
                <div class="btn-group">
                    <a href="#" class="small" onClick="Check(document.presc.check_list);"><span><?php echo smarty_function_xlt(array('t' => 'Check All'), $this);?>
</span></a> |
                    <a href="#" class="small" onClick="Uncheck(document.presc.check_list);"><span><?php echo smarty_function_xlt(array('t' => 'Clear All'), $this);?>
</span></a>
                </div>
            </div>
            <div class="col-12">
                <div id="prescription_list">
                    <form name="presc">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                    <!-- TajEmo Changes 2012/06/14 02:01:43 PM by CB added Heading for checkbox column -->
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th><?php echo smarty_function_xlt(array('t' => 'Drug'), $this);?>
</th>
                                        <th><?php echo smarty_function_xlt(array('t' => 'RxNorm'), $this);?>
</th>
                                        <th><?php echo smarty_function_xlt(array('t' => 'Created'), $this);?>
<br /><?php echo smarty_function_xlt(array('t' => 'Changed'), $this);?>
</th>
                                        <th><?php echo smarty_function_xlt(array('t' => 'Dosage'), $this);?>
</th>
                                        <th><?php echo smarty_function_xlt(array('t' => 'Qty'), $this);?>
.</th>
                                        <th><?php echo smarty_function_xlt(array('t' => 'Unit'), $this);?>
</th>
                                        <th><?php echo smarty_function_xlt(array('t' => 'Refills'), $this);?>
</th>
                                        <th><?php echo smarty_function_xlt(array('t' => 'Provider'), $this);?>
</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $_from = $this->_tpl_vars['prescriptions']; if (($_from instanceof StdClass) || (!is_array($_from) && !is_object($_from))) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['prescription']):
?>
                            <!-- TajEmo Changes 2012/06/14 02:03:17 PM by CB added cursor:pointer for easier user understanding -->
                            <tr id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" class="showborder onescript <?php if ($this->_tpl_vars['prescription']->active <= 0): ?> inactive<?php endif; ?>">
                                <td class="text-center">
                                <input class="check_list" id="check_list" type="checkbox" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" <?php if (! empty ( $this->_tpl_vars['prescription']->encounter ) && $this->_tpl_vars['prescription']->encounter == $this->_tpl_vars['prescription']->get_encounter() && $this->_tpl_vars['prescription']->active > 0): ?>checked="checked" <?php endif; ?>onclick="changeLinkHref('multiprint',this.checked, this.value);changeLinkHref('multiprintcss',this.checked, this.value);changeLinkHref('multiprintToFax',this.checked, this.value)" title="<?php echo smarty_function_xla(array('t' => 'Select for printing'), $this);?>
">
                                </td>
                                <?php if (empty ( $this->_tpl_vars['prescription']->erx_source ) || $this->_tpl_vars['prescription']->erx_source == 0): ?>
                                <td class="editscript"  id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                    <a class='editscript btn btn-primary btn-sm btn-edit' id='<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
' href="<?php echo $this->_tpl_vars['GLOBALS']['webroot']; ?>
/controller.php?prescription&edit&id=<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
"><?php echo smarty_function_xlt(array('t' => 'Edit'), $this);?>
</a>
                                <!-- TajEmo Changes 2012/06/14 02:02:22 PM by CB commented out, to avoid duplicate display of drug name
                                    <?php if ($this->_tpl_vars['prescription']->active > 0): ?><b><?php endif; ?><?php echo $this->_tpl_vars['prescription']->drug; ?>
<?php if ($this->_tpl_vars['prescription']->active > 0): ?></b><?php endif; ?>&nbsp;
                                -->
                                </td>
                                <td class="editscript"  id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                <?php if ($this->_tpl_vars['prescription']->active > 0): ?><b><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->drug)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php if ($this->_tpl_vars['prescription']->active > 0): ?></b><?php endif; ?>&nbsp;
                            <br /><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->note)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                                </td>
                                <?php else: ?>
                            <td>&nbsp;</td>
                                <td id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                <?php if ($this->_tpl_vars['prescription']->active > 0): ?><b><?php endif; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->drug)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<?php if ($this->_tpl_vars['prescription']->active > 0): ?></b><?php endif; ?>&nbsp;
                            <br /><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->note)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                                </td>
                                <?php endif; ?>
                                <td id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->rxnorm_drugcode)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;
                                </td>
                                <td id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['prescription']->date_added)) ? $this->_run_mod_handler('oeFormatShortDate', true, $_tmp) : oeFormatShortDate($_tmp)))) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
<br />
                                <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['prescription']->date_modified)) ? $this->_run_mod_handler('oeFormatShortDate', true, $_tmp) : oeFormatShortDate($_tmp)))) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;
                                </td>
                                <td id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_dosage_display())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 &nbsp;
                                </td>
                                <?php if (empty ( $this->_tpl_vars['prescription']->erx_source ) || $this->_tpl_vars['prescription']->erx_source == 0): ?>
                                <td class="editscript" id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->quantity)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 &nbsp;
                                </td>
                                <?php else: ?>
                                <td id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->quantity)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 &nbsp;
                                </td>
                                <?php endif; ?>
                                <td id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_size())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_unit_display())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;
                                </td>
                                <td id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->refills)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 &nbsp;
                                </td>
                                <td id="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->provider->get_name_display())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
&nbsp;
                                </td>
                                <td><a href="#" id="deleteDrug" class="btn btn-danger btn-sm btn-delete" onclick="deleteDrug(<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
)"><?php echo smarty_function_xlt(array('t' => 'Delete'), $this);?>
</a></td>
                            </tr>
                                <?php endforeach; endif; unset($_from); ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
            <?php if ($this->_tpl_vars['GLOBALS']['rx_show_drug_drug']): ?>
                <div id="drug-drug">
                    <hr>
                    <h3><?php echo smarty_function_xlt(array('t' => 'Drug-Drug Interaction'), $this);?>
</h3>
                    <p title="<?php echo smarty_function_xla(array('t' => 'Severity information will be missing if interaction is found'), $this);?>
"><a href="#">*<?php echo smarty_function_xlt(array('t' => 'Notice'), $this);?>
</a></p>
                    <div id="return_info">
                        <?php echo $this->_tpl_vars['INTERACTION']; ?>

                    </div>
                    <hr>
                </div>
            <?php endif; ?>

            <?php else: ?>
            <div class="text mt-3"><?php echo smarty_function_xlt(array('t' => 'There are currently no prescriptions'), $this);?>
.</div>
            <?php endif; ?>
        </div>
    </div>
</body>
<?php echo '
<script>

$(function () {
$("#multiprint").on("click", function() { return CheckForChecks(document.presc.check_list); });
$("#multiprintcss").on("click", function() { return CheckForChecks(document.presc.check_list); });
$("#multiprintToFax").on("click", function() { return CheckForChecks(document.presc.check_list); });
$(".editscript").on("click", function() { ShowScript(this); });
$(".onescript").on("mouseover", function() { $(this).children().toggleClass("highlight"); });
$(".onescript").on("mouseout", function() { $(this).children().toggleClass("highlight"); });
});

var ShowScript = function(eObj) {
    top.restoreSession();
    objID = eObj.id;
    document.location.href="'; ?>
<?php echo $this->_tpl_vars['GLOBALS']['webroot']; ?>
<?php echo '/controller.php?prescription&edit&id=" + encodeURIComponent(objID);
    return true;
};

</script>
'; ?>

</html>