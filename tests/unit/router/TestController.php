<?php
declare(strict_types=1);


class TestController
{
    public function index(): string
    {
        return "index";
    }

    public function rightOne(): string
    {
        return "1";
    }

    public function rightTwo(): string
    {
        return "2";
    }

    public function wildcard(): string
    {
        return "wildcard";
    }

    public function notFound(): string
    {
        return "404";
    }
}
