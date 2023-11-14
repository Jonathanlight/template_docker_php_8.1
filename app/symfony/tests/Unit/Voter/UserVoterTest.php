<?php

namespace App\Tests\Security\Voter;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use App\Security\Voter\UserVoter;

class UserVoterTest extends TestCase
{
    private UserVoter $voter;
    private TokenInterface $tokenMock;

    protected function setUp(): void
    {
        $this->voter = new UserVoter();
        $this->tokenMock = $this->createMock(TokenInterface::class);
    }

    public function testVoteWithUnsupportedAttribute()
    {
        $this->assertEquals(VoterInterface::ACCESS_ABSTAIN, $this->voter->vote($this->tokenMock, new User(), ['UNSUPPORTED_ATTRIBUTE']));
    }

    public function testVoteWithSupportedAttributeAndUser()
    {
        $this->tokenMock->method('getUser')->willReturn($this->createMock(UserInterface::class));

        $this->assertEquals(VoterInterface::ACCESS_GRANTED, $this->voter->vote($this->tokenMock, new User(), [UserVoter::EDIT]));
        $this->assertEquals(VoterInterface::ACCESS_GRANTED, $this->voter->vote($this->tokenMock, new User(), [UserVoter::VIEW]));
    }

    public function testVoteWithSupportedAttributeAndAnonymousUser()
    {
        $this->tokenMock->method('getUser')->willReturn(null);

        $this->assertEquals(VoterInterface::ACCESS_DENIED, $this->voter->vote($this->tokenMock, new User(), [UserVoter::EDIT]));
        $this->assertEquals(VoterInterface::ACCESS_DENIED, $this->voter->vote($this->tokenMock, new User(), [UserVoter::VIEW]));
    }
}
