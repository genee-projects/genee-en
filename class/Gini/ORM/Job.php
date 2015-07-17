<?php

namespace Gini\ORM;

class Job extends Object {

    var $name         = 'string:40';
    var $title        = 'string:150';
    var $date         = 'datetime';
    var $city         = 'string:40';
    var $type         = 'int,default:0';
    var $weight		  = 'int';
    
    const TYPE_SOCIAL = 0;
    const TYPE_CAMPUS = 1;

}
