<form id="contato" action="contact_page/contatos/enviar" method="POST">
	<input type="text" name="data[nobot]" style="display:none">
	<input type="text" class="" name="data[nome]" is="required">
	<input type="text" class="" name="data[email]" is="email">
	<input type="text" class="" name="data[telefone]" is="phone">
	<select name="data[estado_id]" class="" id="estados">
		<?foreach ($estados as $key => $value) { ?>
			<option value="<?=$key?>"><?=$value?></option>
		<? } ?>
	</select>
	<select name="data[cidade_id]" id="cidades"></select>
	<textarea  class="" name="data[mensagem]" is="required"></textarea>

	<button type="submit">Enviar</button>
</form>

<?=$this->Element('contato')?>
