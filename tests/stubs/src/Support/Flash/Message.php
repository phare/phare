<?php

namespace Stub\Support\Flash;

class Message
{
    public string $message;

    public string $level;

    public function __construct(string $message, string $level)
    {
        $this->message = $message;

        $this->level = $level;
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'level' => $this->level,
        ];
    }
}
