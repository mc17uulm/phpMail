<?php

namespace phpMail;

use MyCLabs\Enum\Enum;

/**
 * Class RecipientType
 * @package phpMail
 *
 * @method static self PUBLIC()
 * @method static self CC()
 * @method static self BCC()
 */
class RecipientType extends Enum
{

    private const PUBLIC = "public";
    private const CC = "cc";
    private const BCC = "bcc";

}