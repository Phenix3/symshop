<?php

namespace App\Service;

use Exception;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class PageManagerService 
{
    private SessionInterface $session;

    public function __construct(protected RequestStack $requestStack)
    {
        $this->session = $this->requestStack->getSession();
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
        throw new Exception("Page title not found", 1);
    }

    public function getDescription()
    {
        if($this->session->has('page_description')) {
            return $this->session->get('page_description');
        }
        throw new Exception("Page description not found", 1);
    }

    public function getIcon()
    {
        return $this->session->has('page_icon') ? $this->session->get('page_icon') : null;
    }

}
