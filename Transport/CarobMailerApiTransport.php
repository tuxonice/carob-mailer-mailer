<?php

namespace Symfony\Component\Mailer\Bridge\CarobMailer\Transport;

use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractApiTransport;
use Symfony\Component\Mime\Email;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

final class CarobMailerApiTransport extends AbstractApiTransport
{
    private const HOST = 'api.carob-mailer.com/api/v1';

    public function __construct(
        string $key,
        HttpClientInterface $client = null,
        EventDispatcherInterface $dispatcher = null,
        LoggerInterface $logger = null
    )
    {
        $this->key = $key;

        parent::__construct($client, $dispatcher, $logger);
    }

    public function __toString(): string
    {
        return sprintf('carobmailer+api://%s', $this->getEndpoint());
    }

    protected function doSendApi(SentMessage $sentMessage, Email $email, Envelope $envelope): ResponseInterface
    {
        //TODO: implement
    }

    private function getEndpoint(): ?string
    {
        return ($this->host ?: self::HOST).($this->port ? ':'.$this->port : '');
    }
}
