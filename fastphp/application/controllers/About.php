<?php

class About extends Controller{
    public function about_show(){

        $this->_views->display("about.html");
    }
}