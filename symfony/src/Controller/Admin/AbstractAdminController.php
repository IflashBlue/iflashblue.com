<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractAdminController extends AbstractController
{
    protected Request $request;

    public function __construct(protected TranslatorInterface $translator, RequestStack $requestStack)
    {
        /** @var Request $request */
        $request = $requestStack->getCurrentRequest();
        $this->request = $request;
    }
}
