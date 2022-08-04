<?php

namespace CfdiUtils\Elements\Cfdi33;

use CfdiUtils\Elements\Common\AbstractElement;

class Emisor extends AbstractElement
{
    public function getElementName(): string
    {
        return 'cfdi:Emisor';
    }
}
