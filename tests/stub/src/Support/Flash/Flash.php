<?php

namespace Stub\Support\Flash;

use Illuminate\Contracts\Session\Session;

class Flash
{
    /** @var \Illuminate\Contracts\Session\Session|\Illuminate\Session\Store */
    protected Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function getMessage(): ?Message
    {
        $flashedMessageProperties = $this->session->get('laravel_flash_message');

        if (! $flashedMessageProperties) {
            return null;
        }

        return new Message(
            $flashedMessageProperties['message'],
            $flashedMessageProperties['level']
        );
    }

    public function flash(Message $message): void
    {
        $this->session->flash('laravel_flash_message', $message->toArray());
    }

    public function error(string $message): void
    {
        $this->flash(new Message($message, 'text-white bg-red-500'));
    }

    public function success(string $message): void
    {
        $this->flash(new Message($message, 'text-white bg-green-500'));
    }

    public function warning(string $message): void
    {
        $this->flash(new Message($message, 'text-white bg-gray-500'));
    }
}
