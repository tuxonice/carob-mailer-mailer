<?php

namespace Symfony\Component\Mailer\Bridge\CarobMailer\Transport;

use Symfony\Component\Mailer\Exception\UnsupportedSchemeException;
use Symfony\Component\Mailer\Transport\AbstractTransportFactory;
use Symfony\Component\Mailer\Transport\Dsn;
use Symfony\Component\Mailer\Transport\TransportInterface;

final class CarobMailerTransportFactory extends AbstractTransportFactory
{
    public function create(Dsn $dsn): TransportInterface
    {
        $scheme = $dsn->getScheme();

        if ('carobmailer+api' === $scheme) {
            $host = 'default' === $dsn->getHost() ? null : $dsn->getHost();
            $port = $dsn->getPort();

            return (new CarobMailerApiTransport(
                $this->getUser($dsn),
                $this->client,
                $this->dispatcher,
                $this->logger)
            )->setHost($host)->setPort($port);
        }

        throw new UnsupportedSchemeException($dsn, 'carobmailer', $this->getSupportedSchemes());
    }

    protected function getSupportedSchemes(): array
    {
        return ['carobmailer+api'];
    }
}
