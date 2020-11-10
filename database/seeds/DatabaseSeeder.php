<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            KnowledgeAreaSeeder::class, 
            RolesSeeder::class, 
            UserSeeder::class, 
            NodeAdminSeeder::class, 
            NodeSeeder::class, 
            EducationalInstitutionAdminSeeder::class, 
            EducationalInstitutionSeeder::class, 
            EducationalEnvironmentSeeder::class, 
            EducationalToolSeeder::class, 
            ResearchGroupSeeder::class, 
            ResearchLineSeeder::class, 
            ResearchTeamAdminSeeder::class, 
            ResearchTeamSeeder::class, 
            ResearchTeamKnowledgeAreaSeeder::class, 
            ResearchTeamResearchLineSeeder::class, 
            StudentSeeder::class, 
            ResearchTeamMemberSeeder::class, 
            AcademicProgramSeeder::class, 
            GruaduationSeeder::class, 
            AcademicWorkSeeder::class,
            ResearcherSeeder::class, 
            EventSeeder::class, 
            EducationalInstitutionEventSeeder::class, 
            NodeEventSeeder::class, 
            ProjectSeeder::class, 
            ProjectAcademicProgramSeeder::class, 
            ProjectKnowledgeAreaSeeder::class, 
            ProjectResearchLineSeeder::class, 
            ProjectResearchTeamSeeder::class, 
            EventProjectSeeder::class,
            AuthorSeeder::class, 
            ResearchOutputSeeder::class, 
            LoanSeeder::class, 
            EducationalEnvironmentLoanSeeder::class, 
            EducationalToolLoanSeeder::class
        ]);
    }
}
