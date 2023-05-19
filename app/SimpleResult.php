<?php

namespace App;

class SimpleResult
{
    private function __construct(
        private readonly bool $success,
        private readonly string $message
    ) {
    }

    public static function success(): self
    {
        return new self(true, 'ok');
    }

    public static function failure(string $message): self
    {
        return new self(false, $message);
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'message' => $this->message,
        ];
    }
}
