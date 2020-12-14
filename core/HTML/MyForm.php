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
	public function input($name, $label, $isRequired = false, $options = []){
		$type = isset($options['type']) ? $options['type'] : 'text';
		$label = '<label><strong>' . $label . '</strong></label>';
		$required = "";
		if($isRequired){
			$required = " required ";
		}
		if ($type === 'textarea') {
			$input = '<textarea name="' . $name . '" class="form-control">' . $this->getValue($name) . '</textarea>';
		}else{
			$input = '<input type="' . $type . '" 
			name="' . $name . '" 
			value="' . $this->getValue($name) . '" 
			' . $required . '
			class="form-control">';
		}
		
		return $this->surround($label . $input);
	}

	/**
	 * génère une liste déroulante contenant les options passées en paramètres
	 * @param $name string 
	 * @param $label string
	 * @param array $options 
	 * @return string 
	 */
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
	 * génère un bouton submit 
	* @return string 
	*/
	public function submit($text='Envoyer'){
		return $this->surround('<button type="submit" class="btn btn-primary">' . $text . '</button>');
	}
}