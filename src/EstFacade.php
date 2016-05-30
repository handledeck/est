<?php
/**
 * Created by PhpStorm.
 * User: asdu6
 * Date: 30.05.2016
 * Time: 14:07
 */

namespace Handledeck\EstTools;

use Illuminate\Support\Facades\Facade;

class EstFacade extends Facade{
    protected static function getFacadeAccessor() { return 'Est'; }
}