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
        'App\Models\AcademicProgram' => 'App\policies\AcademicProgramPolicy',
        'App\Models\AnnualNodeEvent' => 'App\policies\AnnualNodeEventPolicy',
        'App\Models\EducationalEnvironment' => 'App\policies\EducationalEnvironmentPolicy',
        'App\Models\EducationalInstitution' => 'App\policies\EducationalInstitutionPolicy',
        'App\Models\EducationalInstitutionEvent' => 'App\policies\EducationalInstitutionEventPolicy',
        'App\Models\EducationalInstitutionFaculty' => 'App\policies\EducationalInstitutionFacultyPolicy',
        'App\Models\EducationalTool' => 'App\policies\EducationalToolPolicy',
        'App\Models\Event' => 'App\policies\EventPolicy',
        'App\Models\KnowledgeArea' => 'App\policies\KnowledgeAreaPolicy',
        'App\Models\KnowledgeSubarea' => 'App\policies\KnowledgeSubareaPolicy',
        'App\Models\KnowledgeSubareaDiscipline' => 'App\policies\KnowledgeSubareaDisciplinePolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        
    }
}
