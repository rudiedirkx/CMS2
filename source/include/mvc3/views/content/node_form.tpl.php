
<div id="submenu">
<?include('content/submenu.tpl.php')?>
</div>

<h1><?if ($node):?>Edit <?=$ct->node_type_name?>: <?=$node->title?><?else:?>Create node: <?=$ct->node_type_name?><?endif?></h1>

<form method="post" action="/admin/content/<?=$node ? 'node/update' : 'type/'.$ct->node_type.'/insert'?>">
<?if( !empty($_GET['goto']) ):?>
	<input type="hidden" name="goto" value="<?=$_GET['goto']?>" />
<?endif?>
<?if( $node ):?>
	<input type="hidden" name="node_id" value="<?=$node->id?>">
<?endif?>
<fieldset>
	<legend>Node content</legend>

<!-- <pre><? print_r($values) ?></pre> -->

	<?foreach( $ct->fields AS $field ): $name = $field->field_machine_name; ?>
<!-- <? print_r($field) ?> -->
		<p class="field <?=$name?><?if(isset($errors[$name])):?> error<?endif?>"><?=$field->field_title?> (<?=$field->field_type?>)<?if($field->mandatory):?><span class="mandatory"> *</span><?endif?><br>
		<?php
		$value = $values ? $values->{$name} : '';
//		$value = is_array($value) ? implode("\n", $value) : (string)$value;
		$htmlvalue = htmlspecialchars(is_array($value) ? implode("\n", $value) : $value);
		switch ( $field->field_type ):
			case 'integer':
			case 'float':
			case 'string':
			case 'date':
			case 'time':
			case 'dateandtime':
				?>
				<input type="text" name="<?=$name?>" value="<?=$htmlvalue?>" />
				<?php
			break;
			case 'text':
			case 'html':
				?>
				<textarea cols="60" rows="6" name="<?=$name?>"><?=$htmlvalue?></textarea>
				<?php
			break;
			case 'multistring':
				$options = isset($field->options['options']) ? (array)$field->options['options'] : false;
				if ( $options ) {
					?>
					<select name="<?=$name?>[]"<?if( !isset($field->options['max']) || 1 < $field->options['max'] ):?> multiple size="5"<?endif?>>
						<?foreach( $options AS $v ):?>
							<option<?if( in_array($v, $value) ):?> selected<?endif?> value="<?=$v?>"><?=$v?></option>
						<?endforeach?>
					</select>
					<?php
				}
				else {
					?>
					<textarea cols="60" rows="6" name="<?=$name?>"><?=$htmlvalue?></textarea>
					<?php
				}
			break;
			case 'file':
			case 'image':
				?>
				<input type="file" name="<?=$name?>" />
				<?php
			break;
			case 'reference':
				$options = ARONode::finder()->findMany('1');
				?>
				<select name="<?=$name?>">
				<option value="0">-- Choose one --</option>
				<?php
				foreach ( $field->html_options AS $k => $v ) {
					echo '<option'.( $k == $value ? ' selected' : '' ).' value="'.$k.'">'.$v.'</option>';
				}
				?>
				</select>
				<?php
			break;
		endswitch;
		?>
		<?if( isset($errors[$name]) ):?>
			<span class="errmsg"><?=$errors[$name]?></span>
		<?endif?>
		</p>

	<?endforeach?>

	<p class="submit"><input type="submit" value="Save" /></p>
</form>


