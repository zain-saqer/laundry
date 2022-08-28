<?php

namespace App\Tests\Unit\Order\Model;

use App\Laundry\Order\Model\Comment;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @coversNothing
 */
class CommentTest extends TestCase
{
    public function testComment(): void
    {
        $comment1 = Comment::fromString('comment');
        static::assertEquals('comment', $comment1->toString());

        $comment2 = Comment::fromString('comment');
        static::assertEquals($comment1, $comment2);

        $comment3 = Comment::fromString('');
        static::assertNotSame($comment1, $comment3);
    }
}
