<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SessionStore{

    private $session;

    private const ORDER_ID = 'orderId';

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * Set the session
     */
    public function setSession($orderId)
    {
        $this->session->set(self::ORDER_ID, $orderId);
    }

    /**
     * Get the session
     */
    public function getSession()
    {
        return $this->session->get(self::ORDER_ID);
    }

    /**
     * Check if the sesssion is available
     */
    public function isSessionExist()
    {
        return $this->session->has(self::ORDER_ID);
    }

    /**
     * remove session
     */
    public function removeSession()
    {
        $this->session->remove(self::ORDER_ID);
    }

}