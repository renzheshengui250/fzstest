<?php


class Controller
{
    public $_views;
    public function __construct($controName,$actionName)
    {
        $this->_views = new Views($controName,$actionName);
    }
}