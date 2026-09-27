<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('member_badge', template: 'components/member/member_badge.html.twig')]
final class MemberBadge
{
    public string $label = 'Member';

    public ?string $variant = null;
}
