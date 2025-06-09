<?php
namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;

class WelcomeAdminWidget extends Widget
{
    protected static string $view = 'widgets.welcome-Admin-widget';

    // Hanya tampil jika Admin punya role tertentu

    public static function canView(): bool
{
    return in_array(auth()->user()?->role, ['admin', 'user']);
}

}
