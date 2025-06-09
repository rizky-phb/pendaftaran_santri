<?php
namespace App\Filament\User\Widgets;

use Filament\Widgets\Widget;

class WelcomeUserWidget extends Widget
{
    protected static string $view = 'widgets.welcome-user-widget';

    // Hanya tampil jika user punya role tertentu

    public static function canView(): bool
{
    return in_array(auth()->user()?->role, ['admin', 'user']);
}

}
