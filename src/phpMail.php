<?php

namespace phpMail;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Class phpMail
 * @package phpMail
 */
class phpMail
{

    /**
     * @var MailAccount
     */
    private MailAccount $account;
    /**
     * @var MailTemplate
     */
    private MailTemplate $template;
    /**
     * @var array<string>
     */
    private array $attachments;

    /**
     * phpMail constructor.
     * @param MailAccount $account
     * @param MailTemplate $template
     * @param array<string> $attachments
     */
    public function __construct(MailAccount $account, MailTemplate $template, array $attachments = [])
    {
        $this->account = $account;
        $this->template = $template;
        $this->attachments = $attachments;
    }

    /**
     * @param array<Reciever> $receivers
     * @param string $subject
     * @throws MailException
     */
    public function send_to(array $receivers, string $subject) : void
    {
        $mailer = new PHPMailer(true);

        $this->account->initialize_mailer($mailer);

        array_walk($receivers, function(Reciever $r) use (&$mailer){
            switch($r->getType()) {
                case RecipientType::PUBLIC():
                    $mailer->addAddress($r->getAddress(), $r->getName());
                    break;
                case RecipientType::CC():
                    $mailer->addCC($r->getAddress(), $r->getName());
                    break;
                case RecipientType::BCC():
                    $mailer->addBCC($r->getAddress(), $r->getName());
                    break;
                default:
                    throw new MailException("Invalid Recipient type");
            }
        });

        try {

            foreach($this->attachments as $attachment) {
                $mailer->addAttachment($attachment);
            }

            $mailer->isHTML(true);
            $mailer->Subject = $subject;
            $mailer->Body = $this->template->render_html();
            $mailer->AltBody = $this->template->render_text();

            var_dump($mailer);
            die();
            if(!$mailer->send()) {
                throw new MailException("Error sending Mail");
            }

        } catch(Exception $e) {
            throw new MailException("PHPMailer exep: " . $e->getMessage());
        }

    }

}