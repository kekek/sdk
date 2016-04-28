<?php
// +----------------------------------------------------------------------
// |	@desc       Class Sdk.php
// +----------------------------------------------------------------------
// |	@author     jinyifeng
// +----------------------------------------------------------------------
// |	@package    ktkt
// +----------------------------------------------------------------------
// |	@version    $Id:Sdk.php v1.0 16/4/27 下午3:11 $
// +----------------------------------------------------------------------

namespace Kekek\Sdk\Facades;

use Illuminate\Support\Facades\Facade;

class Sdk extends Facade {

    protected static function getFacadeAccessor() { return 'sdk'; }

}
