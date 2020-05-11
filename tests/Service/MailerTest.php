<?php

namespace App\Tests\Service;

use App\Entity\Don;
use App\Entity\Donor;
use App\Service\Mailer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Mailer\MailerInterface;

class MailerTest extends TestCase
{
    private $container;

    public function setUp()
    {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }
    public function testSendReceipt()
    {
        $symfonyMailer = $this->createMock(MailerInterface::class);
        $symfonyMailer->expects($this->once())
            ->method('send');

        $parameterBag = $this->createMock(ParameterBagInterface::class);
        $mailer = new Mailer($symfonyMailer, $parameterBag);
        $donor = new Donor();
        $donor->setFirstName('Med');
        $donor->setLastName('Ben');
        $donor->setEmail('benhenda.med.tn@gmil.com');
        $donor->setCountry('France');
        $donor->setZipCode('44444');
        $donor->setCity('PAris');
        $donor->setAddress('33 rue manhatan');
        $donor->setMobile('333333333');
        $don = new Don();
        $don->setAmount(50);
        $don->setDate(new \DateTime('2020-05-01'));
        $don->setReceiptFile('Official Receipt for Patient.pdf');
        $don->setReceipt(true);
        $don->setDonor($donor);

        $mailer->sendReceipt($don);
    }
}
