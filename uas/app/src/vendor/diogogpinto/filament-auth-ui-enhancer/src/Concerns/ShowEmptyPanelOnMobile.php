<?php

namespace DiogoGPinto\AuthUIEnhancer\Concerns;

trait ShowEmptyPanelOnMobile
{
    public bool $showEmptyPanelOnMobile = true;

    public function showEmptyPanelOnMobile(bool $show = true): self
    {

        $this->showEmptyPanelOnMobile = $show;

        return $this;
    }

    public function getShowEmptyPanelOnMobile(): bool
    {
        return $this->showEmptyPanelOnMobile;
    }
}
