<?php

namespace DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns;

trait HasCustomLayout
{
    public function getLayout(): string
    {
        return 'filament-auth-ui-enhancer::custom-auth-layout';
    }
}
