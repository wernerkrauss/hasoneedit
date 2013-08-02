<?php

class sgn_hasoneedit_DataObjectExtension extends DataExtension {
	public function onBeforeWrite() {
		$changed = $this->owner->getChangedFields();
		$toWrite = array();
		foreach($changed as $name => $value) {
			if(!strpos($name, ':')) {
				// Also skip $name that starts with a :
				continue;
			}
			$value = $value['after'];
			list($hasone, $key) = explode(':', $name, 2);
			if($this->owner->has_one($hasone)) {
				$rel = $this->owner->getComponent($hasone);

				// Get original:
				$original = $rel->__get($key);
				if($original !== $value) {
					$rel->setCastedField($key, $value);
					$toWrite[$hasone] = $rel;
				}
			}
		}
		foreach($toWrite as $rel => $obj) {
			$obj->write();
			$key = $rel . 'ID';
			if(!$this->owner->$key) {
				$this->owner->$key = $obj->ID;
			}
		}
	}
}
