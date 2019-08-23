<?php


namespace Database;


interface ResultSetInterface
{
    /**
     * @return \Generator
     */
    public function fetch(): \Generator;
}