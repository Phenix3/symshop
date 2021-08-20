<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PageManagerService {

    protected $session;

    public function __construct(SessionInterface $session) {
        $this->session = $session;
    }

    public function setVar(string $name, $value)
    {
        $this->session->set($name, $value);
        return $this;
    }

    public function getTitle()
    {
        if($this->session->has('page_title')) {
            return $this->session->get('page_title');
        }
        throw new \Exception("Page title not found", 1);
    }

    public function getDescription()
    {
        if($this->session->has('page_description')) {
            return $this->session->get('page_description');
        }
        throw new \Exception("Page description not found", 1);
    }

    public function getIcon()
    {
        return $this->session->has('page_icon') ? $this->session->get('page_icon') : null;
    }

}
