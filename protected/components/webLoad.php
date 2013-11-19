<?php
class webLoad extends CBehavior{
    private  $_name;
    public function  getName(){
        return $this->_name;
    }
    public function  load($name){
        $this->_name = $name;
        $this->onWebLoad = array($this,'changePath');
        $this->onWebLoad(new CEvent($this->owner));
        $this->owner->run();
    }
    public function  onWebLoad($event){
        $this->raiseEvent('onWebload', $event);
    }
    protected function changePath($event){
        $object = $event->sender;
        $object->controllerPath.=DIRECTORY_SEPARATOR.  $this->_name;
        $object->viewPath.=DIRECTORY_SEPARATOR.  $this->_name;
        var_dump($object->controllerPath);
    }
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
