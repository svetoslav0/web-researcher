<?php


namespace App\Data;


class GoogleDnsApiDTO
{
    /**
     * @var array
     */
    private $answer;

    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param array $answer
     */
    public function setAnswer(array $answer = []): void
    {
        $this->answer = $answer;
    }
}