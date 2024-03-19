<?php

namespace frontend\components;

use Yii;

class Header
{
	public $utm_term;

    public function __construct($utm_term)
	{
		$this->utm_term = $utm_term;
	}

	public function createHeader()
	{
		$working_out = 'Разработка';
	    $create = 'Создание';
	    $sale = 'продающих';
	    $product = array(
	        'Landing',
	        'Лендинг',
	        'Лендингов',
	        'одностраничных сайтов'
	    );
	    $key = ' под ключ';
	    $word_1 = 'Разработка';

	    if(preg_match("/создание/i", $this->utm_term)) $word_1 = $create;
	    else $word_1 = $working_out;
	    if(preg_match("/продающих/i", $this->utm_term)) $word_2 = $sale.' ';
	    else $word_2 = '';

	    if(preg_match("/landing/i", $this->utm_term)) $word_2 .= $product[0].' Page';
	    else if(preg_match("/лендинг /i", $this->utm_term)) $word_2 .= $product[1].' Пейдж';
	    else if(preg_match("/лендингов/i", $this->utm_term)) $word_2 .= $product[2];
	    else if(preg_match("/одностранич/i", $this->utm_term)) $word_2 .= $product[3];
	    else $word_2 .= $product[0].' Page';
	    if(preg_match("/ключ/i", $this->utm_term)) $word_2 .= ' '.$key;
	    $header = $word_1.'<br /><span>'.$word_2.'</span>';
	    return $header;
	}
}

?>
