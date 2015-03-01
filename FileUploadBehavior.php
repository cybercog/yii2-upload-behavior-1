<?php

namespace outtree\uploadbehavior;

/**
 * This is just an example.
 */
class FileUploadBehavior extends \yiidreamteam\upload\FileUploadBehavior
{
    public function beforeSave()
    {
        if ($this->file instanceof UploadedFile) {
            if (!$this->owner->isNewRecord) {
                /** @var static $oldModel */
                $oldModel = $this->owner->findOne($this->owner->primaryKey);
                $oldModel->cleanFiles();
            }
            $this->owner->{$this->attribute} = $this->file->baseName . '.' . $this->file->extension;
        } else { // Fix html forms bug, when we have empty file field
            if (!$this->owner->isNewRecord && empty($this->owner->{$this->attribute})) {
				//$this->owner->{$this->attribute} = ArrayHelper::getValue($this->owner->oldAttributes, $this->attribute, null);
				$oldModel = $this->owner->findOne($this->owner->primaryKey);
                $oldModel->cleanFiles();
			}
        }
    }
}
