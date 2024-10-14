<?php

namespace karyawanmvc\Middleware;

interface Middleware
{
    public function before(): void;
}