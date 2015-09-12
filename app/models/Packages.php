<?php

class Packages extends Eloquent{

	public function Menu(){
		return $this->hasMany('Menu');
	}
} 