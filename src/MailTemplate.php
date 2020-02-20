<?php

namespace phpMail;

interface MailTemplate
{

    public function render_html() : string;
    public function render_text() : string;

}