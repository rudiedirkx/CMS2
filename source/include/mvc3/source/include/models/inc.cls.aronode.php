<?php

class ARONode extends ActiveRecordObject {

	const _TABLE = 'nodes';
	const _PK = 'id';
	public static $_GETTERS = array();



	function render_form( $node ) {
		?>
<form action="">

	<p>Title (string):<br><input type="text" name="title" value="<?=htmlspecialchars($node->title)?>"></p>

	<?foreach($node->_fields AS $field):?>

		<p><?=$field->field_title?> (<?=$field->field_type?>)<br>
		<?php
		$value = $node->{$field->field_machine_name};
		$value = is_array($value) ? implode("\n", $value) : (string)$value;
		$htmlvalue = htmlspecialchars($value);
		switch ( $field->field_type ):
			case 'integer':
			case 'float':
			case 'string':
			case 'date':
			case 'time':
			case 'dateandtime':
				echo '<input type="text" name="'.$field->field_machine_name.'" value="'.$htmlvalue.'">';
			break;
			case 'text':
			case 'html':
			case 'multistring':
				echo '<textarea cols="60" rows="6" name="'.$field->field_machine_name.'">'.$htmlvalue.'</textarea>';
			break;
			case 'file':
			case 'image':
				echo '<input type="file" name="'.$field->field_machine_name.'">';
			break;
			case 'reference':
				$options = ARONode::finder()->findMany('1');
				echo '<select name="'.$field->field_machine_name.'">';
				echo '<option value="0">-- Choose one --</option>';
				foreach ( $options AS $option ) {
					echo '<option'.( $option->id == $value ? ' selected' : '' ).' value="'.$option->id.'">'.$option->title.'</option>';
				}
				echo '</select>';
			break;
		endswitch;
		?>
		</p>

	<?endforeach?>

	<p><input type="submit" value="Save node"></p>

</form>
		<?php
echo '<pre>';
print_r($node);
print_r($this);
	}


	function url() {
		return '/node/'.$this->id;
	}


	function admin_url() {
		return '/admin/content/node/'.$this->id;
	}


	function getQuery( $where ) {
		return 'SELECT t.*, nodes.* FROM nodes, node_types t WHERE nodes.node_type_id = t.id AND '.$where;
	}

	static public function finder( $class = __CLASS__ ) {
		return parent::finder( $class );
	}

}


