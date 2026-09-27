<?php

namespace App\Member\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'team')]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 120)]
    private string $name;

    /** @var Collection<int, Member> */
    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Member::class)]
    private Collection $members;
}
