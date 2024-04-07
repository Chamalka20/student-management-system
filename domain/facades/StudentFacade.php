<?php

namespace domain\facades;

use domain\services\StudentService;
use Illuminate\Support\Facades\Facade;

class StudentFacade extends Facade{

    protected static function getFacadeAccessor()
    {
        return StudentService::class;
    }
}