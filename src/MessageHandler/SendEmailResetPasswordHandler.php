<?php

namespace App\MessageHandler;

use App\Message\SendEmailResetPassword;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class SendEmailResetPasswordHandler implements MessageHandlerInterface
{
    public function __invoke(SendEmailResetPassword $message)
    {
        // do something with your message
    }
}
