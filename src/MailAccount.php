<?php

namespace phpMail;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

/**
 * Class MailAccount
 * @package phpMail
 */
class MailAccount
{

    /**
     * @var string
     */
    private string $host;
    /**
     * @var int
     */
    private int $port;

    /**
     * @var string
     */
    private string $username;
    /**
     * @var string
     */
    private string $password;

    /**
     * @var string
     */
    private string $address;
    /**
     * @var string
     */
    private string $sender;

    /**
     * MailAccount constructor.
     * @param string $host
     * @param int $port
     * @param string $username
     * @param string $password
     * @param string $address
     * @param string $sender
     */
    public function __construct(string $host, int $port, string $username, string $password, string $address, string $sender)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->address = $address;
        $this->sender = $sender;
    }

    public function initialize_mailer(PHPMailer &$mailer) : bool
    {
        try {

            $mailer->SMTPDebug = SMTP::DEBUG_OFF;
            $mailer->Debugoutput = "error_log";
            $mailer->isSMTP();
            $mailer->Host = $this->host;
            $mailer->SMTPAuth = true;
            $mailer->Username = $this->username;
            $mailer->Password = $this->password;
            $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mailer->Port = $this->port;

            $mailer->setFrom($this->address, $this->sender);
            $mailer->addReplyTo($this->address, $this->sender);

            return true;

        } catch (Exception $e) {
            return false;
        }
    }

}