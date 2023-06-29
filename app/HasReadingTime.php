<?php

namespace App;

trait HasReadingTime
{
    public function minutesToRead(): int
    {
        return max(round(str_word_count($this->getContent()) / 220), 1);
    }
}
