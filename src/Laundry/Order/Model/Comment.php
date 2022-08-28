<?php

namespace App\Laundry\Order\Model;

class Comment
{
    private function __construct(
        private readonly ?string $comment
    ) {
    }

    public function toString(): string
    {
        return $this->comment;
    }

    public static function fromString(?string $comment): self
    {
        return new self($comment);
    }
}
