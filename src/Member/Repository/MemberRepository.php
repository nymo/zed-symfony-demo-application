<?php

namespace App\Member\Repository;

use App\Member\Entity\Member;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class MemberRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Member::class);
    }

    public function activeMembers(): QueryBuilder
    {
        return $this->createQueryBuilder('member')
            ->andWhere('member.email = :email')
            ->orderBy('member.email');
    }

    public function explicitEntityAlias(QueryBuilder $queryBuilder): QueryBuilder
    {
        return $queryBuilder
            ->from(Member::class, 'm')
            ->andWhere('m.email = :email')
            ->orderBy('m.email');
    }
}
