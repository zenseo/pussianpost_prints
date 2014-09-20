<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div class="vtabs">
          <?php $module_row = 1; ?>
          <?php foreach ($modules as $module) { ?>
          <a href="#tab-module-<?php echo $module_row; ?>" id="module-<?php echo $module_row; ?>"><?php echo $module['description']; ?>&nbsp;<img src="view/image/delete.png" alt="" onclick="$('.vtabs a:first').trigger('click'); $('#module-<?php echo $module_row; ?>').remove(); $('#tab-module-<?php echo $module_row; ?>').remove(); return false;" /></a>
          <?php $module_row++; ?>
          <?php } ?>
          <span id="module-add"><?php echo $button_add_profile; ?>&nbsp;<img src="view/image/add.png" alt="" onclick="addProfile();" /></span> </div>
        <?php $module_row = 1; ?>
        <?php foreach ($modules as $module) { ?>
        <div id="tab-module-<?php echo $module_row; ?>" class="vtabs-content">
          <table class="form">
            <tr>
              <td><?php echo $entry_description; ?></td>
              <td><input type="text" name="ruspost_form_module[<?php echo $module_row; ?>][description] id="description-<?php echo $module_row; ?>" value="<?php echo isset($module['description']) ? $module['description'] : ''; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_fio; ?></td>
              <td><input name="ruspost_form_module[<?php echo $module_row; ?>][sender_name]" value="<?php echo $module['sender_name']; ?>" size="80">
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_zip; ?></td>
              <td><input name="ruspost_form_module[<?php echo $module_row; ?>][sender_index]" value="<?php echo $module['sender_index']; ?>">
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_address; ?></td>
              <td><textarea name="ruspost_form_module[<?php echo $module_row; ?>][sender_address]" cols="80" rows="2"><?php echo $module['sender_address']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_phone; ?></td>
              <td>+7 <input type="text" name="ruspost_form_module[<?php echo $module_row; ?>][sender_phone]" value="<?php echo $module['sender_phone']; ?>" size="15" />
              </td>
            </tr>

            <tr>
              <td><?php echo $entry_jurfiz; ?></td>
              <td><input type="checkbox" class="jurfiz_cb" name="ruspost_form_module[<?php echo $module_row; ?>][sender_jurfiz]" <?php echo (isset($module['sender_jurfiz']) && $module['sender_jurfiz'] ? 'checked="checked"' : ''); ?> value="1" />
              </td>
            </tr>

            <tr class="jur">
              <td><?php echo $entry_inn; ?></td>
              <td><input name="ruspost_form_module[<?php echo $module_row; ?>][sender_inn]" value="<?php echo $module['sender_inn']; ?>">
              </td>
            </tr>
            <tr class="jur">
              <td><?php echo $entry_bank; ?></td>
              <td><input name="ruspost_form_module[<?php echo $module_row; ?>][sender_bank]" value="<?php echo $module['sender_bank']; ?>" size="80" />
              </td>
            </tr>
            <tr class="jur">
              <td><?php echo $entry_korr; ?></td>
              <td><input name="ruspost_form_module[<?php echo $module_row; ?>][sender_korr]" value="<?php echo $module['sender_korr']; ?>">
              </td>
            </tr>
            <tr class="jur">
              <td><?php echo $entry_rs; ?></td>
              <td><input name="ruspost_form_module[<?php echo $module_row; ?>][sender_rs]" value="<?php echo $module['sender_rs']; ?>">
              </td>
            </tr>
            <tr class="jur">
              <td><?php echo $entry_bik; ?></td>
              <td><input name="ruspost_form_module[<?php echo $module_row; ?>][sender_bik]" value="<?php echo $module['sender_bik']; ?>">
              </td>
            </tr>


            <tr class="fiz">
              <td><?php echo $entry_docname; ?></td>
              <td><input name="ruspost_form_module[<?php echo $module_row; ?>][sender_document_doc]" value="<?php echo $module['sender_document_doc']; ?>">
              </td>
            </tr>
            <tr class="fiz">
              <td><?php echo $entry_doccode; ?></td>
              <td>
              <input name="ruspost_form_module[<?php echo $module_row; ?>][sender_document_ser]" value="<?php echo $module['sender_document_ser']; ?>" size="4">/
              <input name="ruspost_form_module[<?php echo $module_row; ?>][sender_document_nomer]" value="<?php echo $module['sender_document_nomer']; ?>" size="6">
              </td>
            </tr>
            <tr class="fiz">
              <td><?php echo $entry_docissued; ?></td>
              <td><textarea name="ruspost_form_module[<?php echo $module_row; ?>][sender_document_vydan]" cols="80" rows="2"><?php echo $module['sender_document_vydan']; ?></textarea>
              </td>
            </tr>
            <tr class="fiz">
              <td><?php echo $entry_docdate; ?></td>
              <td>
              <input name="ruspost_form_module[<?php echo $module_row; ?>][sender_document_vydanday]" value="<?php echo $module['sender_document_vydanday']; ?>" size="10">
              20<input name="ruspost_form_module[<?php echo $module_row; ?>][sender_document_vydanyear]" value="<?php echo $module['sender_document_vydanyear']; ?>" size="2">
              </td>
            </tr>
            <input type="hidden" name="ruspost_form_module[<?php echo $module_row; ?>][status]" value="0" />
            <input type="hidden" name="ruspost_form_module[<?php echo $module_row; ?>][layout_id]" value="0" />
          </table>
        </div>
        <?php $module_row++; ?>
        <?php } ?>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addProfile() {	
    html  = '    <div id="tab-module-' + module_row + '" class="vtabs-content">';
    html += '      <table class="form">';
    html += '        <tr>';
    html += '          <td><?php echo $entry_description; ?></td>';
    html += '          <td><input type="text" name="ruspost_form_module[' + module_row + '][description] id="description-' + module_row + '" value="<?php echo $entry_profile; ?> ' + module_row + '" /></td>';
    html += '        </tr>';
    html += '        <tr>';
    html += '          <td><?php echo $entry_fio; ?></td>';
    html += '          <td><input name="ruspost_form_module[' + module_row + '][sender_name]" value="Топорков Михаил Кирыч" size="80">';
    html += '          </td>';
    html += '        </tr>';
    html += '        <tr>';
    html += '          <td><?php echo $entry_zip; ?></td>';
    html += '          <td><input name="ruspost_form_module[' + module_row + '][sender_index]" value="391110">';
    html += '          </td>';
    html += '        </tr>';
    html += '        <tr>';
    html += '          <td><?php echo $entry_address; ?></td>';
    html += '          <td><textarea name="ruspost_form_module[' + module_row + '][sender_address]" cols="80" rows="2">Рязанская_обл., г.Рыбное, ул._Прогресса-2, д.9_кв.9</textarea>';
    html += '          </td>';
    html += '        </tr>';
    
    html += '        <tr>';
    html += '          <td><?php echo $entry_jurfiz ?></td>';
    html += '          <td><input type="checkbox" class="jurfiz_cb" name="ruspost_form_module[' + module_row + '][sender_jurfiz]" value="1" />';
    html += '          </td>';
    html += '        </tr>';

    html += '        <tr class="jur">';
    html += '          <td><?php echo $entry_inn; ?></td>';
    html += '          <td><input name="ruspost_form_module[' + module_row + '][sender_inn]" value="">';
    html += '          </td>';
    html += '        </tr>';
    html += '        <tr class="jur">';
    html += '          <td><?php echo $entry_bank; ?></td>';
    html += '          <td><input name="ruspost_form_module[' + module_row + '][sender_bank]" value="ЗАО &quot;Мострансроспилбанк&quot;" size="80" />';
    html += '          </td>';
    html += '        </tr>';
    html += '        <tr class="jur">';
    html += '          <td><?php echo $entry_korr; ?></td>';
    html += '          <td><input name="ruspost_form_module[' + module_row + '][sender_korr]" value="">';
    html += '          </td>';
    html += '        </tr>';
    html += '        <tr class="jur">';
    html += '          <td><?php echo $entry_rs; ?></td>';
    html += '          <td><input name="ruspost_form_module[' + module_row + '][sender_rs]" value="">';
    html += '          </td>';
    html += '        </tr>';
    html += '        <tr class="jur">';
    html += '          <td><?php echo $entry_bik; ?></td>';
    html += '          <td><input name="ruspost_form_module[' + module_row + '][sender_bik]" value="">';
    html += '          </td>';
    html += '        </tr>';

    html += '        <tr class="fiz">';
    html += '          <td><?php echo $entry_docname; ?></td>';
    html += '          <td><input name="ruspost_form_module[' + module_row + '][sender_document_doc]" value="паспорт">';
    html += '          </td>';
    html += '        </tr>';
    html += '        <tr class="fiz">';
    html += '          <td><?php echo $entry_doccode; ?></td>';
    html += '          <td>';
    html += '          <input name="ruspost_form_module[' + module_row + '][sender_document_ser]" value="6101" size="4">/';
    html += '          <input name="ruspost_form_module[' + module_row + '][sender_document_nomer]" value="123456" size="6">';
    html += '          </td>';
    html += '        </tr>';
    html += '        <tr class="fiz">';
    html += '          <td><?php echo $entry_docissued; ?></td>';
    html += '          <td><textarea name="ruspost_form_module[' + module_row + '][sender_document_vydan]" cols="80" rows="2">Октябрьским РОВД гор. Рязани</textarea>';
    html += '          </td>';
    html += '        </tr>';
    html += '        <tr class="fiz">';
    html += '          <td><?php echo $entry_docdate; ?></td>';
    html += '          <td>';
    html += '          <input name="ruspost_form_module[' + module_row + '][sender_document_vydanday]" value="1 апреля" size="10">';
    html += '          20<input name="ruspost_form_module[<?php echo $module_row; ?>][sender_document_vydanyear]" value="03" size="2">';
    html += '          </td>';
    html += '        </tr>';
    html += '        <input type="hidden" name="ruspost_form_module[' + module_row + '][status]" value="0" /><input type="hidden" name="ruspost_form_module[' + module_row + '][layout_id]" value="0" /></table>';
    html += '    </div>';
	
	var form = $(html);
	handleJurFiz(form.find('.jurfiz_cb'));
	form.find('.jurfiz_cb').trigger('change');
	$('#form').append(form);
	
	$('#module-add').before('<a href="#tab-module-' + module_row + '" id="module-' + module_row + '"><?php echo $entry_profile; ?> ' + module_row + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'.vtabs a:first\').trigger(\'click\'); $(\'#module-' + module_row + '\').remove(); $(\'#tab-module-' + module_row + '\').remove(); return false;" /></a>');
	
	$('.vtabs a').tabs();
	
	$('#module-' + module_row).trigger('click');

	module_row++;
}
//--></script> 
<script type="text/javascript"><!--
$('.vtabs a').tabs();


function handleJurFiz(ctx) {
	ctx.change(function() {
		var tbl = ctx.parents('table');
		if (ctx.is(':checked')) {
			tbl.find('.jur').show();
			tbl.find('.fiz').hide();
		}
		else {
			tbl.find('.jur').hide();
			tbl.find('.fiz').show();
		}
	})
}

$('.jurfiz_cb').each(function() {
	handleJurFiz($(this));
	$(this).trigger('change');
})
//--></script> 
<?php echo $footer; ?>
