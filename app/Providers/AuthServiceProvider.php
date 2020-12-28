<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\legalInformation' => 'App\Policies\LegalInformationPolicy',
        'App\Models\NodeEvent' => 'App\Policies\NodeEventPolicy',
        'App\Models\Node' => 'App\Policies\NodePolicy',
        'App\Models\Project' => 'App\Policies\ProjectPolicy',
        'App\Models\ProjectType' => 'App\Policies\ProjectTypePolicy',
        'App\Models\ResearchGroup' => 'App\Policies\ResearchGroupPolicy',
        'App\Models\ResearchLine' => 'App\Policies\ResearchLinePolicy',
        'App\Models\ResearchOutput' => 'App\Policies\ResearchOutputPolicy',
        'App\Models\ResearchTeam' => 'App\Policies\ResearchTeamPolicy',
        'App\Models\Role' => 'App\Policies\RolePolicy',
        'App\Models\User' => 'App\Policies\UserPolicy',
        'App\Models\UserAcademicWork' => 'App\Policies\UserAcademicWorkPolicy',
        'App\Models\UserGraduation' => 'App\Policies\UserGraduationPolicy',
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
