<?php

namespace DiogoGPinto\AuthUIEnhancer\Pages\Auth;

use DiogoGPinto\AuthUIEnhancer\Pages\Auth\Concerns\HasCustomLayout;
use Filament\Pages\Auth\Login as BaseLogin;

class AuthUiEnhancerLogin extends BaseLogin
{
    use HasCustomLayout;
}
