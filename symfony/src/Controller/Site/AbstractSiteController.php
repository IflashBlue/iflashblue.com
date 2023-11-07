<?php

namespace App\Controller\Site;

use App\Entity\Configuration\Configuration;
use App\Repository\ConfigurationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractSiteController extends AbstractController
{
    protected Request $request;

    public function __construct(protected TranslatorInterface $translator, RequestStack $requestStack, protected readonly ConfigurationRepository $configurationRepository)
    {
        /** @var Request $request */
        $request = $requestStack->getCurrentRequest();
        $this->request = $request;
    }
}
