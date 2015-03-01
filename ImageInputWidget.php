<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImageInputWidget
 *
 * @author LGJ
 */
class ImageInputWidget extends \kartik\file\FileInput {
	
	public $options = ['accept' => 'image/*'];
	public $pluginEvents = ['fileclear' => "function(event){console.log(event.currentTarget.defaultValue='');}"];
	public $pluginOptions = ['showUpload' => FALSE];
	public $model;
	
	public function __construct()
	{
		if ($imgUrl = $this->model->getImageFileUrl('image')) {
			$this->pluginOptions = array_merge($this->pluginOptions, [
				'initialPreview' => [
					Html::img($imgUrl, ['class' => 'file-preview-image', 'alt'=>$this->value, 'title'=>$this->value]),
				],
				'initialCaption' => $this->value,
			]);
		}
		parent::__construct();
	}
}
