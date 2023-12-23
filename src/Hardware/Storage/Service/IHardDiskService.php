<?php

namespace Mahmodi\ComputerSimulator\Hardware\Storage\Service;

use Mahmodi\ComputerSimulator\Hardware\Storage\HardDisk;
use Mahmodi\ComputerSimulator\Hardware\Storage\Helper\DirectoryHelper;

interface IHardDiskService
{
    /**
     *
     * @param string $path
     * @return boolean
     * @throws \Exception
     */
    public function create(string $path): bool;

    /**
     * @param string $path
     * @param bool $strict
     * @return bool
     */
    public function delete(string $path, bool $strict = false): bool;

    /**
     * @param string $path
     * @param string $where
     * @param bool $replace
     * @return bool
     * @throws \Exception
     */
    public function move(string $path, string $where, bool $replace = false): bool;

    /**
     * @param string $path
     * @param string $where
     * @param bool $replace
     * @return bool
     */
    public function copy(string $path, string $where, bool $replace = true): bool;

    /**
     * @param string $path
     * @param bool $hidden
     * @return array|false
     */
    public function list(string $path, bool $hidden = false): array|false;
}