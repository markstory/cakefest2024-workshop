<?php
namespace App\Model\Enum;

enum MemberRoleEnum: string
{
    case Member = 'member';
    case Manager = 'manager';
    case Owner = 'owner';
}
