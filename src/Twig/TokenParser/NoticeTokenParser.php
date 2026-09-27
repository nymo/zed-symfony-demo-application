<?php

namespace App\Twig\TokenParser;

use Twig\Node\Node;
use Twig\Token;
use Twig\TokenParser\AbstractTokenParser;

final class NoticeTokenParser extends AbstractTokenParser
{
    public function parse(Token $token): Node
    {
        $stream = $this->parser->getStream();
        $stream->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideNoticeEnd'], true);
        $stream->expect(Token::BLOCK_END_TYPE);

        return new Node(['body' => $body], [], $token->getLine());
    }

    public function decideNoticeEnd(Token $token): bool
    {
        return $token->test('endnotice');
    }

    public function getTag(): string
    {
        return 'notice';
    }
}
