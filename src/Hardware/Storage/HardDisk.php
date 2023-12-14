<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage;

use Mahmodi\ComputerSimulator\Hardware\Storage\Trait\HasAssetBuilder;
use Mahmodi\ComputerSimulator\Hardware\Storage\Trait\HasFacades;

class HardDisk
{
    use HasFacades;

    /**
     * آدرس فولدر روت هارد که تمامی فایل ها
     * و فولدر ها درون آن ذخیره می شوند
     */
    private const ROOT_DIRECTORY = 'root/';

    /**
     * آدرس فولدر روت هارد دیسک را باز می گرداند
     * 
     * آدرس کامل فولدر روت را با توجه به ROOT_DIRECTORY 
     * باز می گرداند
     *
     * @return string
     */
    public static function rootDirectoryPath():string
    {
        return rtrim(__DIR__ . DIRECTORY_SEPARATOR . self::ROOT_DIRECTORY, '/\\ .');
    }
}
