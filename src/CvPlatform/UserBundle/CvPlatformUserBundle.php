<?php

namespace CvPlatform\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CvPlatformUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
