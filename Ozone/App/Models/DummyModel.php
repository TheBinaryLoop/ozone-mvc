<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 20.04.2018
 * Time: 13:29
 */

namespace Ozone\App\Models;
use Ozone\Core\Base\OzoneModel as Model;


/**
 * Class DummyModel
 * @package Ozone\App\Models
 */
class DummyModel extends Model
{
    public function dummys()
    {
        return $this->has_many('Dummy');
    }
}