<?php

namespace phpMail;

/**
 * Class Reciever
 * @package phpMail
 */
class Reciever
{

    /**
     * @var string
     */
    private string $address;
    /**
     * @var string
     */
    private string $name;

    /**
     * @var RecipientType
     */
    private RecipientType $type;

    /**
     * Reciever constructor.
     * @param string $address
     * @param string $name
     * @param RecipientType|null $type
     */
    public function __construct(string $address, string $name, RecipientType $type = null)
    {
        if(is_null($type)) {
            $type = RecipientType::PUBLIC();
        }
        $this->address = $address;
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return RecipientType
     */
    public function getType(): RecipientType
    {
        return $this->type;
    }



}