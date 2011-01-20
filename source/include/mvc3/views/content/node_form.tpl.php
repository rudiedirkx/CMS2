
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

	<?foreach( $ct->fields AS $field ):?>
		<p class="field <?=$field->field_machine_name?><?if(isset($errors[$field->field_machine_name])):?> error<?endif?>"><?=$field->field_title?> (<?=$field->field_type?>)<?if($field->mandatory):?><span class="mandatory"> *</span><?endif?><br>
		<?php
		$value = $values ? $values->{$field->field_machine_name} : '';
		$value = is_array($value) ? implode("\n", $value) : (string)$value;
		$htmlvalue = htmlspecialchars($value);
		switch ( $field->field_type ):
			case 'integer':
			case 'float':
			case 'string':
			case 'date':
			case 'time':
			case 'dateandtime':
				?>
				<input type="text" name="<?=$field->field_machine_name?>" value="<?=$htmlvalue?>" />
				<?php
			break;
			case 'text':
			case 'html':
			case 'multistring':
				?>
				<textarea cols="60" rows="6" name="<?=$field->field_machine_name?>"><?=$htmlvalue?></textarea>
				<?php
			break;
			case 'file':
			case 'image':
				?>
				<input type="file" name="<?=$field->field_machine_name?>" />
				<?php
			break;
			case 'reference':
				$options = ARONode::finder()->findMany('1');
				?>
				<select name="<?=$field->field_machine_name?>">
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
		</p>

	<?endforeach?>

	<p class="submit"><input type="submit" value="Save" /></p>
</form>


