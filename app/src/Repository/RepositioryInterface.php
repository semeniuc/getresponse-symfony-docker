<?php

namespace App\Repository;

interface RepositioryInterface
{
    public function get();
    public function add();
    public function upd();
    public function del();
}