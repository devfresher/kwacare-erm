<?php /* Smarty version 2.6.33, created on 2023-01-28 15:28:17
         compiled from C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'headerTemplate', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 14, false),array('function', 'xlt', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 97, false),array('function', 'xla', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 103, false),array('function', 'amcCollect', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 119, false),array('function', 'html_options', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 156, false),array('function', 'html_radios', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 269, false),array('function', 'xlj', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 420, false),array('function', 'datetimepickerSupport', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 450, false),array('modifier', 'js_url', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 74, false),array('modifier', 'attr', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 104, false),array('modifier', 'text', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 105, false),array('modifier', 'attr_url', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 111, false),array('modifier', 'oeFormatShortDate', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 152, false),array('modifier', 'js_escape', 'C:/xampp/htdocs/kwara-erm/templates/prescription/general_edit.html', 330, false),)), $this); ?>
<!DOCTYPE html>
<html>
<head>

    <?php echo smarty_function_headerTemplate(array('assets' => 'datetime-picker|select2'), $this);?>


<script>

<?php echo '
    function my_process_lookup(drug, rxcode = \'\') {
      // Pass the variable
      let newOption = new Option(drug, drug, true, true);
      $("#rxnorm_drugcode").val(rxcode);
      $(\'#drug\').append(newOption).trigger(\'change\');
      $(\'#hiddendiv\').hide();
      $("#hiddendiv").html( "&nbsp;" );
    }
'; ?>

</script>
<!---Gen Look up-->
<?php echo '
<script>

 // This holds all the default drug attributes.
 // This was html escaped previously
'; ?>

 var drugopts = [<?php if (! empty ( $this->_tpl_vars['DRUG_ATTRIBUTES'] )): ?><?php echo $this->_tpl_vars['DRUG_ATTRIBUTES']; ?>
<?php endif; ?>];
<?php echo '

 // Helper to choose an option from its value.
 function selchoose(sel, value) {
  var o = sel.options;
  for (let i = 0; i < o.length; ++i) {
   o[i].selected = (o[i].value == value);
  }
 }

 // Fill in default values when a drop-down drug is selected.
 function drugselected(sel) {
  var f = document.forms[0];
  var i = f.drug_id.selectedIndex - 1;
  if (i >= 0) {
   var d = drugopts[i];
   var newOption = new Option(d[0], d[0], true, true);
   $(\'#drug\').append(newOption).trigger(\'change\');
   selchoose(f.form, d[1]);
   f.dosage.value = d[2];
   f.size.value = d[3];
   f.rxnorm_drugcode.value = d[11];
   selchoose(f.unit, d[4]);
   selchoose(f.route, d[5]);
   selchoose(f.interval, d[6]);
   selchoose(f.substitute, d[7]);
   f.quantity.value = d[8];
   f.disp_quantity.value = d[8];
   selchoose(f.refills, d[9]);
   f.per_refill.value = d[10];
  }
 }

 // Invoke the popup to dispense a drug.
 function dispense() {
  var f = document.forms[0];
  dlgopen(\'interface/drugs/dispense_drug.php\' +
   '; ?>
'?drug_id=' + <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_drug_id())) ? $this->_run_mod_handler('js_url', true, $_tmp) : js_url($_tmp)); ?>
 +<?php echo '
   \'&prescription=\' + encodeURIComponent(f.id.value) +
   \'&quantity=\' + encodeURIComponent(f.disp_quantity.value) +
   \'&fee=\' + encodeURIComponent(f.disp_fee.value),
   \'_blank\', 400, 200);
 }

 function quantityChanged() {
  var f = document.forms[0];
  f.per_refill.value = f.quantity.value;
  if (f.disp_quantity) {
   f.disp_quantity.value = f.quantity.value;
  }
 }

</script>
'; ?>

</head>
<body id="prescription_edit">
<div class="container">
    <form name="prescribe" id="prescribe"  method="post" action="<?php echo $this->_tpl_vars['FORM_ACTION']; ?>
" >
        <table>
            <tr>
                <td class="title font-weight-bold"><?php echo smarty_function_xlt(array('t' => 'Add'), $this);?>
/<?php echo smarty_function_xlt(array('t' => 'Edit'), $this);?>
&nbsp;</td>
                <td>
                    <a id="save" href=# onclick="submitfun();" class="btn btn-primary btn-sm btn-save"><?php echo smarty_function_xlt(array('t' => 'Save'), $this);?>
</a>
                    <?php if (! empty ( $this->_tpl_vars['DRUG_ARRAY_VALUES'] )): ?>
                    &nbsp; &nbsp; &nbsp; &nbsp;
                    <?php if ($this->_tpl_vars['prescription']->get_refills() >= $this->_tpl_vars['prescription']->get_dispensation_count()): ?>
                        <input type="submit" name="disp_button"class='btn btn-primary btn-sm my-0 mr-1 ml-1' value="<?php echo smarty_function_xla(array('t' => 'Save and Dispense'), $this);?>
" />
                        <input class="input-sm" type="text" name="disp_quantity" size="2" maxlength="10" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DISP_QUANTITY'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                        units, <?php echo ((is_array($_tmp=$this->_tpl_vars['GBL_CURRENCY_SYMBOL'])) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>

                        <input class="input-sm" type="text" name="disp_fee" size="5" maxlength="10" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['DISP_FEE'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                    <?php else: ?>&nbsp;
                        <?php echo smarty_function_xlt(array('t' => 'prescription has reached its limit of'), $this);?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->get_refills())) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
 <?php echo smarty_function_xlt(array('t' => 'refills'), $this);?>
.
                    <?php endif; ?>
                <?php endif; ?>
                <a id="back" class='btn btn-secondary btn-sm btn-back' href="controller.php?prescription&list&id=<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->patient->id)) ? $this->_run_mod_handler('attr_url', true, $_tmp) : attr_url($_tmp)); ?>
"><?php echo smarty_function_xlt(array('t' => 'Back'), $this);?>
</a>
                </td>
            </tr>
        </table>

        <?php if ($this->_tpl_vars['GLOBALS']['enable_amc_prompting']): ?>
        <div class='float-right border mr-5'>
            <div class='float-left m-1'>
            <?php echo smarty_function_amcCollect(array('amc_id' => 'e_prescribe_amc','patient_id' => $this->_tpl_vars['prescription']->patient->id,'object_category' => 'prescriptions','object_id' => $this->_tpl_vars['prescription']->id), $this);?>

            <?php if (! $this->_tpl_vars['amcCollectReturn']): ?>
                <input type="checkbox" id="escribe_flag" name="escribe_flag" />
            <?php else: ?>
                <input type="checkbox" id="escribe_flag" name="escribe_flag" checked="checked" />
            <?php endif; ?>
            <span class="text"><?php echo smarty_function_xlt(array('t' => 'E-Prescription?'), $this);?>
</span><br />

            <?php echo smarty_function_amcCollect(array('amc_id' => 'e_prescribe_chk_formulary_amc','patient_id' => $this->_tpl_vars['prescription']->patient->id,'object_category' => 'prescriptions','object_id' => $this->_tpl_vars['prescription']->id), $this);?>

            <?php if (! $this->_tpl_vars['amcCollectReturn']): ?>
                <input type="checkbox" id="checked_formulary_flag" name="checked_formulary_flag" />
            <?php else: ?>
                <input type="checkbox" id="checked_formulary_flag" name="checked_formulary_flag" checked="checked" />
            <?php endif; ?>
            <span class="text"><?php echo smarty_function_xlt(array('t' => 'Checked Drug Formulary?'), $this);?>
</span><br />

            <?php echo smarty_function_amcCollect(array('amc_id' => 'e_prescribe_cont_subst_amc','patient_id' => $this->_tpl_vars['prescription']->patient->id,'object_category' => 'prescriptions','object_id' => $this->_tpl_vars['prescription']->id), $this);?>

            <?php if (! $this->_tpl_vars['amcCollectReturn']): ?>
                <input type="checkbox" id="controlled_substance_flag" name="controlled_substance_flag" />
            <?php else: ?>
                <input type="checkbox" id="controlled_substance_flag" name="controlled_substance_flag" checked="checked" />
            <?php endif; ?>
            <span class="text"><?php echo smarty_function_xlt(array('t' => 'Controlled Substance?'), $this);?>
</span><br />
            </div>
        </div>
        <?php endif; ?>

        <div class="form-group mt-3">
            <label><?php echo smarty_function_xlt(array('t' => 'Currently Active'), $this);?>
</label>
            <input class="input-sm" type="checkbox" name="active" value="1"<?php if ($this->_tpl_vars['prescription']->get_active() > 0): ?> checked<?php endif; ?> />
        </div>
        <div class="form-group mt-3">
            <label><?php echo smarty_function_xlt(array('t' => 'Starting Date'), $this);?>
</label>
            <input type="text" size="10" class="datepicker form-control" name="start_date" id="start_date" value="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['prescription']->start_date)) ? $this->_run_mod_handler('oeFormatShortDate', true, $_tmp) : oeFormatShortDate($_tmp)))) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
        </div>
        <div class="form-group mt-3">
            <label><?php echo smarty_function_xlt(array('t' => 'Provider'), $this);?>
</label>
            <?php echo smarty_function_html_options(array('class' => "input-sm form-control",'name' => 'provider_id','options' => $this->_tpl_vars['prescription']->provider->utility_provider_array(),'selected' => $this->_tpl_vars['prescription']->provider->get_id()), $this);?>

            <input type="hidden" name="patient_id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->patient->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
        </div>
        <div class="form-group mt-3">
            <label class="mr-2"><?php echo smarty_function_xlt(array('t' => 'Drug'), $this);?>
</label>
            <div class="form-check-inline">
                <label class="form-check-label" title="<?php echo smarty_function_xlt(array('t' => 'Search from native inventory drugs table'), $this);?>
">
                    <input type="radio" class="form-check-input" name="rxcui_select" checked /><?php echo smarty_function_xlt(array('t' => 'Use Default'), $this);?>

                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label" title="<?php echo smarty_function_xlt(array('t' => 'Search from external RxNorm table. Vocabulary RXNORM'), $this);?>
">
                    <input type="radio" class="form-check-input" name="rxcui_select" <?php if (empty ( $this->_tpl_vars['RXNORMS_AVAILABLE'] )): ?> disabled<?php else: ?> checked<?php endif; ?> /><?php echo smarty_function_xlt(array('t' => 'Use RxNorm'), $this);?>

                </label>
            </div>
            <div class="form-check-inline">
                <label class="form-check-label" title="<?php echo smarty_function_xlt(array('t' => 'Search from native loaded RxCUI table.'), $this);?>
">
                    <input type="radio" class="form-check-input" name="rxcui_select" <?php if (empty ( $this->_tpl_vars['RXCUI_AVAILABLE'] )): ?>disabled<?php else: ?> checked<?php endif; ?>  /><?php echo smarty_function_xlt(array('t' => 'Use RxCUI'), $this);?>

                </label>
            </div>
            <select class="input-sm form-control" type="input" name="drug" id="drug"></select>
            <a href="javascript:;" id="druglookup" class="small" name="B4" onclick="$('#hiddendiv').show(); document.getElementById('hiddendiv').innerHTML='&lt;iframe src=&quot;controller.php?prescription&amp;lookup&amp;drug=&quot; width=&quot;100%&quot;height=&quot;75&quot; scrolling=&quot;no&quot; frameborder=&quot;no&quot;&gt;&lt;/iframe&gt;'">
                (<?php echo smarty_function_xlt(array('t' => 'Search Web API'), $this);?>
)
            </a>
            <div class="jumbotron jumbotron-fluid" id="hiddendiv" style="display: none">&nbsp;</div>
        </div>
        <?php if (! empty ( $this->_tpl_vars['DRUG_ARRAY_VALUES'] )): ?>
        <div class="form-group mt-3">
            <label>&nbsp; <?php echo smarty_function_xlt(array('t' => 'in-house'), $this);?>
</label>
            <select class="input-sm form-control" name="drug_id" onchange="drugselected(this)">
                <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['DRUG_ARRAY_VALUES'],'output' => $this->_tpl_vars['DRUG_ARRAY_OUTPUT'],'selected' => $this->_tpl_vars['prescription']->get_drug_id()), $this);?>

            </select>
            <input type="hidden" name="rxnorm_drugcode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->rxnorm_drugcode)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
">
        </div>
        <?php endif; ?>
        <div class="form-group mt-3">
            <label><?php echo smarty_function_xlt(array('t' => 'Quantity'), $this);?>
</label>
            <input class="input-sm form-control" type="text" name="quantity" id="quantity" size="10" maxlength="31"
                value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->quantity)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" onchange="quantityChanged()" />
        </div>
        <?php if ($this->_tpl_vars['SIMPLIFIED_PRESCRIPTIONS'] && ! $this->_tpl_vars['prescription']->size): ?>
        <div class="form-group row mt-3 d-none">
        <?php else: ?>
        <div class="form-group row mt-3">
        <?php endif; ?>
            <div class="col-12">
                <label><?php echo smarty_function_xlt(array('t' => 'Medicine Units'), $this);?>
</label>
            </div>
            <div class="col">
                <input class="input-sm form-control" type="text" name="size" id="size" size="11" maxlength="10" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->size)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"/>
            </div>
            <div class="col">
                <select class="input-sm form-control" name="unit" id="unit"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['prescription']->unit_array,'selected' => $this->_tpl_vars['prescription']->unit), $this);?>
</select>
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-12">
                <label><?php echo smarty_function_xlt(array('t' => 'Directions'), $this);?>
</label>
            </div>
            <?php if ($this->_tpl_vars['SIMPLIFIED_PRESCRIPTIONS'] && ! $this->_tpl_vars['prescription']->form && ! $this->_tpl_vars['prescription']->route && ! $this->_tpl_vars['prescription']->interval): ?>
                <input class="input-sm form-control" type="text" name="dosage" id="dosage" size="30" maxlength="100" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->dosage)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                <input type="hidden" name="form" id="form" value="0" />
                <input type="hidden" name="route" id="route" value="0" />
                <input type="hidden" name="interval" id="interval" value="0" />
            <?php else: ?>
                <div class="col">
                    <input class="input-sm form-control" type="text" name="dosage" id="dosage" size="2" maxlength="10" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->dosage)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
"/>
                </div>
                <div class="col">
                    <?php echo smarty_function_xlt(array('t' => 'in'), $this);?>

                </div>
                <div class="col">
                    <select class="input-sm form-control" name="form" id="form"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['prescription']->form_array,'selected' => $this->_tpl_vars['prescription']->form), $this);?>
</select>
                </div>
                <div class="col">
                    <select class="input-sm form-control" name="route" id="route"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['prescription']->route_array,'selected' => $this->_tpl_vars['prescription']->route), $this);?>
</select>
                </div>
                <div class="col">
                    <select class="input-sm form-control" name="interval" id="interval"><?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['prescription']->interval_array,'selected' => $this->_tpl_vars['prescription']->interval), $this);?>
</select>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group row mt-3">
            <div class="col-12">
                <label><?php echo smarty_function_xlt(array('t' => 'Refills'), $this);?>
</label>
            </div>
            <div class="col">
                <?php echo smarty_function_html_options(array('name' => 'refills','class' => "form-control",'options' => $this->_tpl_vars['prescription']->refills_array,'selected' => $this->_tpl_vars['prescription']->refills), $this);?>

            </div>
            <?php if ($this->_tpl_vars['SIMPLIFIED_PRESCRIPTIONS']): ?>
                <input type="hidden" id="per_refill" name="per_refill" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->per_refill)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
            <?php else: ?>
                <div class="col">
                    &nbsp; &nbsp; # <?php echo smarty_function_xlt(array('t' => 'of tablets'), $this);?>
:
                </div>
                <div class="col">
                    <input class="input-sm form-control" type="text" id="per_refill" name="per_refill" size="2" maxlength="10" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->per_refill)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
                </div>
            <?php endif; ?>
        </div>
        <div class="form-group mt-3">
            <label><?php echo smarty_function_xlt(array('t' => 'Notes'), $this);?>
</label>
            <textarea class="form-control" name="note" cols="30" rows="1" wrap="virtual"><?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->note)) ? $this->_run_mod_handler('text', true, $_tmp) : text($_tmp)); ?>
</textarea>
        </div>
        <div class="form-group row mt-3">
            <?php if ($this->_tpl_vars['WEIGHT_LOSS_CLINIC']): ?>
                <label><?php echo smarty_function_xlt(array('t' => 'Substitution'), $this);?>
</label>
                <?php echo smarty_function_html_options(array('name' => 'substitute','class' => "form-control",'options' => $this->_tpl_vars['prescription']->substitute_array,'selected' => $this->_tpl_vars['prescription']->substitute), $this);?>

            <?php else: ?>
                <div class="col-12">
                    <label><?php echo smarty_function_xlt(array('t' => 'Add to Medication List'), $this);?>
</label>
                </div>
                <div class="col">
                    <?php echo smarty_function_html_radios(array('class' => "input-sm",'name' => 'medication','options' => $this->_tpl_vars['prescription']->medication_array,'selected' => $this->_tpl_vars['prescription']->medication), $this);?>

                </div>
                <div class="col">
                    <?php echo smarty_function_html_options(array('class' => "input-sm form-control",'name' => 'substitute','options' => $this->_tpl_vars['prescription']->substitute_array,'selected' => $this->_tpl_vars['prescription']->substitute), $this);?>

                </div>
            <?php endif; ?>
        </div>

        <input type="hidden" name="id" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->id)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
        <input type="hidden" name="process" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['PROCESS'])) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />
        <input type="hidden" id="rxnorm_drugcode" name="rxnorm_drugcode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->rxnorm_drugcode)) ? $this->_run_mod_handler('attr', true, $_tmp) : attr($_tmp)); ?>
" />

        <script>
            <?php if (! empty ( $this->_tpl_vars['ENDING_JAVASCRIPT'] )): ?><?php echo $this->_tpl_vars['ENDING_JAVASCRIPT']; ?>
<?php endif; ?>
        </script>
    </form>
</div>
<?php echo '
<!-- for the fancy jQuery stuff -->
<script>

function submitfun() {
    top.restoreSession();
    if (CheckForErrors(this)) {
        document.forms["prescribe"].submit();
    }
    else {
        return false;
    }
}

function iframetopardiv(string){
    var name=string
    document.getElementById(\'drug\').value=name;
    $("#hiddendiv").html( "&nbsp;" );
    $(\'#hiddendiv\').hide();
}

function cancelParlookup () {
    $(\'#hiddendiv\').hide();
    $("#hiddendiv").html( "&nbsp;" );
}

$(function () {

    $("#save,#back").on("click",function(){
        $("#clearButton",window.parent.document).css("display", "none");
        $("#backButton",window.parent.document).css("display", "none");
        $("#addButton",window.parent.document).css("display", "");
    });

    '; ?>

    <?php if ($this->_tpl_vars['GLOBALS']['weno_rx_enable']): ?>
        <?php echo '
        $("#drug").select2({
        ajax: {
            url: "library/ajax/drug_autocomplete/search.php",
            dataType: \'json\',
            data: function(params) {
                return {
                  '; ?>

                  csrf_token_form: <?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
,
                  term: params.term
                  <?php echo '
                };
            },
            processResults: function(data) {
                return  {
                    results: $.map(data, function(item, index) {
                      return {
                            text: item,
                            id: index,
                            value: item
                        }
                    })
                };
                return x;
            },
            cache: true,
            minimumInputLength: 3
            }
          });
        '; ?>

    <?php else: ?>
        <?php echo '
        $("#drug").select2({
        ajax: {
            url: "library/ajax/prescription_drugname_lookup.php",
            dataType: \'json\',
            data: function(params) {
                return {
                  '; ?>

                  csrf_token_form: <?php echo ((is_array($_tmp=$this->_tpl_vars['CSRF_TOKEN_FORM'])) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
,
                  <?php echo '
                  term: params.term,
                  use_rxnorm: document.prescribe.rxcui_select[1].checked,
                  use_rxcui: document.prescribe.rxcui_select[2].checked
                }
            },
            processResults: function(data) {
                return  {
                    results: $.map(data, function(item, index) {
                        return {
                            text: item[\'display_name\'],
                            id: item[\'id_name\'],
                            value: item[\'display_name\']
                        }
                    })
                };
                return x;
            },
            cache: true
            },
            tags: true,
            minimumInputLength: 3
          });
        '; ?>

    <?php endif; ?>
    <?php if ($this->_tpl_vars['prescription']->drug): ?>
        <?php echo '
        // Show the current drug name in the select
        var newOption = new Option('; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->drug)) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
, <?php echo ((is_array($_tmp=$this->_tpl_vars['prescription']->drug)) ? $this->_run_mod_handler('js_escape', true, $_tmp) : js_escape($_tmp)); ?>
<?php echo ', true, true);
        $(\'#drug\').append(newOption).trigger(\'change\');
        '; ?>

    <?php endif; ?>

    <?php echo '
    $("#drug").focus();
    $("#prescribe").submit(function() { return CheckForErrors(this) });
});

// check the form for required fields before submitting
var CheckForErrors = function(eObj) {
    // REQUIRED FIELDS
    if (CheckRequired(\'drug\') == false) { return false; }
    if (CheckRequired(\'quantity\') == false) { return false; }
    //if (CheckRequired(\'unit\') == false) { return false; }
    //if (CheckRequired(\'size\') == false) { return false; }
    if (CheckRequired(\'dosage\') == false) { return false; }
    //if (CheckRequired(\'form\') == false) { return false; }
    //if (CheckRequired(\'route\') == false) { return false; }
    //if (CheckRequired(\'interval\') == false) { return false; }

    return top.restoreSession();
};

function CheckRequired(objID) {

    // for text boxes
    if ($(\'#\'+objID).is(\'input\')) {
        if ($(\'#\'+objID).val() == "") {
            alert('; ?>
<?php echo smarty_function_xlj(array('t' => 'Missing a required field and will be highlighted'), $this);?>
<?php echo ');
            $(\'#\'+objID).css("backgroundColor", "pink");
            return false;
        }
    }

    // for select boxes
    if ($(\'#\'+objID).is(\'select\')) {
        if ($(\'#\'+objID).val() == "0") {
            alert('; ?>
<?php echo smarty_function_xlj(array('t' => 'Missing a required field'), $this);?>
<?php echo ');
            $(\'#\'+objID).css("backgroundColor", "pink");
            return false;
        }
    }

    return true;
}

    $(document).on(\'select2:select\', \'select#drug\', function(e) {
        let idx = this.selectedIndex;
        if (idx === 0) {
            // already selected.
            return false;
        }
        let optionText = document.getElementById("drug").options[idx].text;
        let rxcode = (optionText.split(\'(RxCUI:\').pop().split(\')\')[0]).trim();
        $("#rxnorm_drugcode").val(rxcode);
    });

$(function () {'; ?>

    <?php echo smarty_function_datetimepickerSupport(array('input' => 'format'), $this);?>

<?php echo '});</script>



'; ?>

</body>
</html>