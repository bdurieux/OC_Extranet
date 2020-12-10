<?php
namespace Core\HTML;
/**
 * 
 */
class MyForm extends Form
{
	
	
	/**
	* @param $html Code html à entourer
	* @return string 
	*/
	protected function surround($html){
		return "<div class=\"form-group\">{$html}</div>";
	}

	/**
	* @param $name string 
	* @param $label string
	* @param array $options 
	* @return string 
	*/
	public function input($name, $label, $options = []){
		$type = isset($options['type']) ? $options['type'] : 'text';
		$label = '<label><strong>' . $label . '</strong></label>';
		if ($type === 'textarea') {
			$input = '<textarea name="' . $name . '" class="form-control">' . $this->getValue($name) . '</textarea>';
		}else{
			$input = '<input type="' . $type . '" name="' . $name . '" value="' . $this->getValue($name) . '" class="form-control">';
		}
		
		return $this->surround($label . $input);
	}

	public function select($name, $label, $options){
		$label = '<label>' . $label . '</label>';
		$input = '<select class="form-control" name="' . $name . '">';		
		foreach ($options as $key => $value) {
			$attributes = '';
			if ($key == $this->getValue($name)) {
				$attributes = ' selected';
			}
			$input .= "<option value='$key' $attributes>$value</option>";
		}
		$input .= '</select>';
		return $this->surround($label . $input);
	}

	/**
	* @return string 
	*/
	public function submit($text='Envoyer'){
		return $this->surround('<button type="submit" class="btn btn-primary">' . $text . '</button>');
	}
}