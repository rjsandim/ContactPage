<form id="contato" action="contact_page/contatos/enviar" method="POST">
	<input type="text" name="data[Contato][nobot]" style="display:none">
	<input type="text" class="" name="data[Contato][nome]" is="required">
	<input type="text" class="" name="data[Contato][email]" is="email">
	<input type="text" class="" name="data[Contato][telefone]" is="phone">
	<select name="data[Contato][estado_id]" class="" id="estados">
		<?foreach ($estados as $key => $value) { ?>
			<option value="<?=$key?>"><?=$value?></option>
		<? } ?>
	</select>
	<select name="data[Contato][cidade_id]" id="cidades"></select>
	<textarea  class="" name="data[Contato][mensagem]" is="required"></textarea>

	<button type="submit">Enviar</button>
</form>

<?=$this->Element('contato')?>
