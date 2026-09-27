<?php

namespace App\Twig;

use App\Twig\TokenParser\NoticeTokenParser;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\TwigTest;

final class MemberExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [new TwigFunction('member_label', [$this, 'memberLabel'])];
    }

    public function getFilters(): array
    {
        return [new TwigFilter('member_slug', [$this, 'slugify'])];
    }

    public function getTests(): array
    {
        return [new TwigTest('member_active', [$this, 'isActive'])];
    }

    public function getTokenParsers(): array
    {
        return [new NoticeTokenParser()];
    }

    public function memberLabel(object $member): string
    {
        return 'Member';
    }

    public function slugify(string $value): string
    {
        return strtolower(str_replace(' ', '-', $value));
    }

    public function isActive(mixed $value): bool
    {
        return true;
    }
}
