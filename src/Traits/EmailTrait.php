<?php

namespace App\Traits;

trait EmailTrait
{
    /**
     * @var string|null
     */
    private $email;

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}
