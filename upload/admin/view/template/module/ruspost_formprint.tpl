<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html; charset="UTF-8" />
<title>Печать форм почтовых отправлений</title>
<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>
</head>
<body>
<div id="data_form">
<form id="form1" name="form1" method="post">
<table width="850" border="0" cellspacing="3" cellpadding="1" align="center">
   <tr>
	<td width="50%" valign="top">
	<table width="425" border="0" cellspacing="3" cellpadding="1">
		<tr>
			<td colspan="2"><h3>Отправитель <select id="profile"><option value="">Выберите профиль</option></select></h3></td>
		</tr>
		<tr>
			<td width="132"><label for="arr[sender_name">Ф.И.О. </label></td>
			<td width="300"><input name="arr[sender_name]" type="text" id="sender_name" value="<?php echo $arr['sender_name'];?>" size="30" /></td>
		</tr>
		<tr>
			<td><label for="arr[sender_index]">Почтовый индекс</label></td>
			<td><input type="text" name="arr[sender_index]" id="sender_index" value="<?php echo $arr['sender_index'];?>" size="7" /></td>
		</tr>
		<tr>
			<td><label for="arr[sender_address]">Адрес</label></td>
			<td><textarea name="arr[sender_address]" id="sender_address" cols="30"><?php echo $arr['sender_address'];?></textarea></td>
		</tr>
		<tr>
			<td><label for="arr[sender_phone]">Телефон</label></td>
			<td>+7 <input name="arr[sender_phone]" type="text" id="sender_phone" size="15" value="<?php echo $arr['sender_phone'];?>" /></td>
		</tr>
		
		
		<tr>
		  <td>Юрлицо</label></td>
		  <td><input type="checkbox" class="jurfiz_cb" name="arr[sender_jurfiz]" <?php echo (isset($arr['sender_jurfiz']) && $arr['sender_jurfiz'] ? 'checked="checked"' : ''); ?> value="1" />
		  </td>
		</tr>

		<tr class="jur">
		  <td><label for="arr[sender_inn]">ИНН</label></td>
		  <td><input name="arr[sender_inn]" value="<?php echo $arr['sender_inn']; ?>" id="sender_inn" size="10" />
		  </td>
		</tr>
		<tr class="jur">
		  <td><label for="arr[sender_bank]">Название банка</label></td>
		  <td><input name="arr[sender_bank]" value="<?php echo $arr['sender_bank']; ?>" size="30" id="sender_bank" />
		  </td>
		</tr>
		<tr class="jur">
		  <td><label for="arr[sender_korr]">Корр. счет</label></td>
		  <td><input name="arr[sender_korr]" value="<?php echo $arr['sender_korr']; ?>" id="sender_korr" size="16" />
		  </td>
		</tr>
		<tr class="jur">
		  <td><label for="arr[sender_rs]">Расч. счет</label></td>
		  <td><input name="arr[sender_rs]" value="<?php echo $arr['sender_rs']; ?>" id="sender_rs" size="16" />
		  </td>
		</tr>
		<tr class="jur">
		  <td><label for="arr[sender_bik]">БИК</label></td>
		  <td><input name="arr[sender_bik]" value="<?php echo $arr['sender_bik']; ?>" id="sender_bik" size="16" />
		  </td>
		</tr>
		
		<tr class="fiz">
			<td><label for="arr[sender_document_doc]">Документ</label></td>
			<td><input type="text" name="arr[sender_document_doc]" id="sender_document_doc" value="<?php echo $arr['sender_document_doc'];?>" size="7" /></td>
		</tr>
		<tr class="fiz">
			<td><label for="arr[sender_document_ser]">Серия/номер</label></td>
			<td><input type="text" name="arr[sender_document_ser]" id="sender_document_ser" value="<?php echo $arr['sender_document_ser'];?>" size="3" />/
			<input type="text" name="arr[sender_document_nomer]" id="sender_document_nomer" value="<?php echo $arr['sender_document_nomer'];?>" size="6" />
			</td>
		</tr>
		<tr class="fiz">
			<td><label for="arr[sender_document_vydan]">Выдан</label></td>
			<td><textarea name="arr[sender_document_vydan]" id="sender_document_vydan" cols="30"><?php echo $arr['sender_document_vydan'];?></textarea></td>
		</tr>
		<tr class="fiz">
			<td><label for="arr[sender_document_vydanday]">Дата выдачи</label></td>
			<td><input type="text" name="arr[sender_document_vydanday]" id="sender_document_vydanday" value="<?php echo $arr['sender_document_vydanday'];?>" size="10" />&nbsp;
			20<input type="text" name="arr[sender_document_vydanyear]" id="sender_document_vydanyear" value="<?php echo $arr['sender_document_vydanyear'];?>" size="1" />
			</td>
		</tr>
  	</table>
	</td>
	
	<td width="50%" valign="top">
	<table width="425" border="0" cellspacing="3" cellpadding="1">
		<tr>
			<td colspan="2"><h3>Покупатель</h3></td>
		</tr>
		<tr>
			<td width="136"><label for="arr[addr_surname">Ф.И.О. </label></td>
			<td width="300"><input name="arr[addr_name]" type="text" id="addr_name" value="<?php echo $arr['addr_name'];?>" size="30" /></td>
		</tr>
		<tr>
			<td>Почтовый индекс</td>
			<td><input type="text" name="arr[addr_index]" id="addr_index" value="<?php echo $arr['addr_index'];?>" size="7" /></td>
		</tr>
		<tr>
			<td>Адрес</td>
			<td><textarea name="arr[addr_address]" id="addr_address" cols="30"><?php echo $arr['addr_address'];?></textarea></td>
		</tr>
		<tr>
			<td><label for="arr[addr_phone]">Телефон</label></td>
			<td>+7 <input name="arr[addr_phone]" type="text" id="addr_phone" size="15" value="<?php echo $arr['addr_phone'];?>" /></td>
		</tr>
		<tr>
			<td><strong>Сумма заказа </strong></td>
			<td><strong><input type="text" name="arr[addr_sum]" id="addr_sum" value="<?php echo $arr['addr_sum'];?>" /></strong></td>
		</tr>
    	</table>
	</td>
  </tr>

  <tr>
    <td colspan="2" align="center">
		<input type="hidden" name="act" id="act" value="<?php echo (isset($act) ? $act : 'none'); ?>"/>
		<input type="submit" name="but_print" value="Бланк Ф.113 + Ф.117" id="but_print" onClick='document.form1.act.value="print"'>
		<input type="submit" name="but_f112ep" value="Бланк Ф.112ЭП" id="but_print" onClick='document.form1.act.value="f112ep"'>
		<input type="submit" name="but_f113" value="Бланк Ф.113ЭН" id="but_print" onClick='document.form1.act.value="f113"'>
		<input type="submit" name="but_f116" value="Бланк Ф.116" id="but_print" onClick='document.form1.act.value="f116"'>
		<input type="submit" name="but_sticker" value="Наклейка" id="but_sticker" onClick='document.form1.act.value="sticker"'>
		<input type="submit" name="but_opis" value="Опись вложения" id="but_print" onClick='document.form1.act.value="opis"'>
	</td>
  </tr>
</table>
</form>
</div>
<script type="text/javascript">
$(document).ready(function() {
	var profiles = <?php echo $modules; ?>;
	$.each(profiles, function(i,v) {
		$('#profile').append('<option value="' + i + '">' + v.description + '</option>');
	})
	$('#profile').change(function() {
		if ($('#profile').val() != '') {
			$.each(profiles[$('#profile').val()], function(k,v) {
				$('#' + k).val(v);
			})
		}
		if (profiles[$('#profile').val()]['sender_jurfiz']) {
			$('.jurfiz_cb').attr('checked', 'checked');
			$('.jurfiz_cb').trigger('change');
		}
		else {
			$('.jurfiz_cb').removeAttr('checked', 'checked');
			$('.jurfiz_cb').trigger('change');
		}
	})

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

handleJurFiz($('.jurfiz_cb'));
$('.jurfiz_cb').trigger('change');
})
</script>
</body>
</html>
