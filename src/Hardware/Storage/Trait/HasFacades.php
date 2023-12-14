<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Trait;

use Mahmodi\ComputerSimulator\Hardware\Storage\Service\Directory;

/**
 * متود های مربوط به ساخت فایل و فولدر را شامل می شود
 *
 * تمامی متود های مربوط به ساخت فایل ،فولدر ، جستجوی
 * فایل ، جستجوی فولدر و غیره در این تریت قرار دارد
 */
trait HasFacades
{
    /**
     * نمونه شی Directory را باز می گرداند
     *
     * @return Directory
     */
    public static function directory():Directory
    {
        return new Directory();
    }
}