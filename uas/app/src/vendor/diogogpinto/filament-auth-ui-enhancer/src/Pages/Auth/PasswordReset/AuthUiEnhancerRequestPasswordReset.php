<?php

namespace DiogoGPinto\AuthUIEnhancer\Pages\Auth\PasswordReset;

use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;
use Filament\Pages\Auth\PasswordReset\RequestPasswordReset;

class AuthUiEnhancerRequestPasswordReset extends RequestPasswordReset
{
    use HasCustomLayout;
}
