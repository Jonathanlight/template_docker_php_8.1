<?php

namespace App\Tests\Unit\EventSubscriber;

use App\EventSubscriber\ExceptionSubscriber;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Mailer\MailerInterface;

class ExceptionSubscriberTest extends TestCase
{
    //on test le fait que notre subscriber écoute bien l'évènement ExceptionEvent
    public function testEventExceptionSubscriber(): void
    {
        $this->assertArrayHasKey(ExceptionEvent::class, ExceptionSubscriber::getSubscribedEvents());
    }

    public function testOnExceptionSendMail(): void
    {
        $mailer = $this->getMockBuilder(MailerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $subscriber = new ExceptionSubscriber($mailer, 'domain@tmail.fr', 'client@tmail.fr');

        $kernel = $this->getMockBuilder(KernelInterface::class)
            ->getMock();

        $event = new ExceptionEvent($kernel, new Request(), 1, new \Exception('test'));

        $mailer->expects($this->once())
            ->method('send');

        $dispatcher = new EventDispatcher();
        $dispatcher->addSubscriber($subscriber);
        $dispatcher->dispatch($event);
    }
}