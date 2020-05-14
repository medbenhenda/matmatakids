<?php


namespace App\Service;

use App\Entity\Don;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class Mailer
{
    private $mailer;
    private $parameterBag;
    public function __construct(MailerInterface $mailer, ParameterBagInterface $parameterBag)
    {
        $this->mailer = $mailer;
        $this->parameterBag = $parameterBag;
    }
    public function sendReceipt(Don $don)
    {
        $pdf = $this->parameterBag->get('kernel.project_dir') . '/public/receipt/'.$don->getReceiptFile();
        $email = (new TemplatedEmail())
            ->htmlTemplate('receipt/receipt.html.twig')
            ->from(new Address($this->parameterBag->get('email_sender'), 'Matmata kids'))
            ->to(new Address($don->getDonor()->getEmail(), $don->getDonor()))
            ->subject('Reçu fiscal Matmata kids')
            ->attachFromPath($pdf, sprintf('reçu-fiscal-%s.pdf', date('Y-m-d')));
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {

            //@TODO add custom message and notification
        }
    }
}
