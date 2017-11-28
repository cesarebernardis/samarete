<?php

namespace Samarete\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Samarete\Models\Chat' => 'Samarete\Policies\ChatPolicy',
        'Samarete\Models\User' => 'Samarete\Policies\UserPolicy',
        'Samarete\Models\Ruolo' => 'Samarete\Policies\RuoloPolicy',
        'Samarete\Models\Permesso' => 'Samarete\Policies\PermessoPolicy',
        'Samarete\Models\File' => 'Samarete\Policies\FilePolicy',
        'Samarete\Models\FileTmp' => 'Samarete\Policies\FileTmpPolicy',
        'Samarete\Models\Associazione' => 'Samarete\Policies\AssociazionePolicy',
        'Samarete\Models\Evento' => 'Samarete\Policies\EventoPolicy',
        'Samarete\Models\Servizio' => 'Samarete\Policies\ServizioPolicy',
        'Samarete\Models\Progetto' => 'Samarete\Policies\ProgettoPolicy',
        'Samarete\Models\Richiesta' => 'Samarete\Policies\RichiestaPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
