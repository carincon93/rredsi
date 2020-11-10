import IndexResearchers from '~/views/Researchers/Index.js';
import CreateResearchers from '~/views/Researchers/Create.js';
import EditResearchers from '~/views/Researchers/Edit.js';
import DetailResearchers from '~/views/Researchers/Detail.js';

import IndexResearchTeamAdmins from './views/ResearchTeamAdmins/Index';
import CreateResearchTeamAdmins from './views/ResearchTeamAdmins/Create.js';
import EditResearchTeamAdmins from './views/ResearchTeamAdmins/Edit.js';
import DetailResearchTeamAdmins from './views/ResearchTeamAdmins/Detail.js';

import IndexEducationalInstitutionAdmins from '~/views/EducationalInstitutionAdmins/Index.js';
import CreateEducationalInstitutionAdmins from '~/views/EducationalInstitutionAdmins/Create.js';
import DetailEducationalInstitutionAdmins from '~/views/EducationalInstitutionAdmins/Detail.js';
import EditEducationalInstitutionAdmins from '~/views/EducationalInstitutionAdmins/Edit.js';

import IndexEducationalInstitutions from '~/views/EducationalInstitutions/Index.js';
import CreateEducationalInstitutions from '~/views/EducationalInstitutions/Create.js';
import DetailEducationalInstitutions from '~/views/EducationalInstitutions/Detail.js';
import EditEducationalInstitutions from '~/views/EducationalInstitutions/Edit.js';

import IndexNodeAdmins from '~/views/NodeAdmins/Index.js';
import CreateNodeAdmins from '~/views/NodeAdmins/Create.js';
import DetailNodeAdmins from '~/views/NodeAdmins/Detail.js';
import EditNodeAdmins from '~/views/NodeAdmins/Edit.js';

import IndexNodes from '~/views/Nodes/Index.js';
import CreateNodes from '~/views/Nodes/Create.js';
import DetailNodes from '~/views/Nodes/Detail.js';
import EditNodes from '~/views/Nodes/Edit.js';

import IndexReasearchLines from '~/views/ResearchLines/Index.js';
import CreateResearchLines from '~/views/ResearchLines/Create.js';
import DetailResearchLines from '~/views/ResearchLines/Detail.js';
import EditResearchLines from '~/views/ResearchLines/Edit.js';

import IndexResearchGroups from '~/views/ResearchGroups/Index.js';
import CreateResearchGroups from '~/views/ResearchGroups/Create.js';
import DetailResearchGroups from '~/views/ResearchGroups/Detail.js';
import EditResearchGroup from '~/views/ResearchGroups/Edit.js';

import IndexKnowledgeArea from '~/views/KnowledgeAreas/Index.js';
import CreateKnowledgeArea from '~/views/KnowledgeAreas/Create.js';
import EditKnowledgeArea from '~/views/KnowledgeAreas/Edit.js';
import DetailKnowledgeArea from '~/views/KnowledgeAreas/Detail.js';

import IndexAcademicProgram from '~/views/AcademicPrograms/Index.js';
import CreateAcademicProgram from '~/views/AcademicPrograms/Create.js';
import EditAcademicProgram from '~/views/AcademicPrograms/Edit.js';
import DetailAcademicProgram from '~/views/AcademicPrograms/Detail.js';

import IndexResearchTeams from '~/views/ResearchTeams/Index.js';
import CreateResearchTeams from '~/views/ResearchTeams/Create.js';
import EditResearchTeams from '~/views/ResearchTeams/Edit.js';
import DetailResearchTeams from '~/views/ResearchTeams/Detail.js';

import IndexEducationalEnvironments from '~/views/EducationalEnvironments/Index.js';
import CreateEducationalEnvironments from '~/views/EducationalEnvironments/Create.js';
import EditEducationalEnvironments from '~/views/EducationalEnvironments/Edit.js';
import DetailEducationalEnvironments from '~/views/EducationalEnvironments/Detail.js';

import IndexEducationalEnvironmentsLoanRequest from '~/views/EducationalEnvironments/LoanRequest/Index.js';
import CheckEducationalEnvironmentsLoanRequest from '~/views/EducationalEnvironments/LoanRequest/Check.js';
import CreateEducationalEnvironmentsLoanRequest from '~/views/EducationalEnvironments/LoanRequest/Create.js';

import IndexEducationalEnvironmentsLoanReturn from '~/views/EducationalEnvironments/LoanReturn/Index.js';
import CheckEducationalEnvironmentsLoanReturn from '~/views/EducationalEnvironments/LoanReturn/Check.js';

import IndexEducationalTools from '~/views/EducationalTools/Index.js';
import CreateEducationalTools from '~/views/EducationalTools/Create.js';
import DetailEducationalTools from '~/views/EducationalTools/Detail.js';
import EditEducationalTools from '~/views/EducationalTools/Edit.js';

import IndexEducationalToolLoanRequest from '~/views/EducationalTools/LoanRequest/Index.js';
import CreateEducationalToolLoanRequest from '~/views/EducationalTools/LoanRequest/Create.js';
import CheckEducationalToolLoanRequest from '~/views/EducationalTools/LoanRequest/Check.js';

import IndexEducationalToolsLoanReturn from '~/views/EducationalTools/LoanReturns/Index.js';
import CheckEducationalToolsLoanReturn from '~/views/EducationalTools/LoanReturns/Check.js';

import Login from '~/views/Login.js';

var routes = [
  {
    path: '/login',
    name: 'Login',
    icon: '',
    layout: '/app',
    component: Login 
  },
  {
    path: '/researchers/list',
    name: 'Researchers',
    icon: '',
    layout: '/app',
    component: IndexResearchers
  },
  {
    path: '/researchers/create',
    name: 'Researchers',
    icon: '',
    layout: '/app',
    component: CreateResearchers
  },
  {
    path: '/researchers/edit/:id',
    name: 'Researchers',
    icon: '',
    layout: '/app',
    component: EditResearchers
  },
  {
    path: '/researchers/detail/:id',
    name: 'Researchers',
    icon: '',
    layout: '/app',
    component: DetailResearchers
  },
  {
    path: '/research-team-admins/list',
    name: 'Research Team Admins',
    icon: '',
    layout: '/app',
    component: IndexResearchTeamAdmins
  },
  {
    path: '/research-team-admins/create',
    name: 'Research Team Admins',
    icon: '',
    layout: '/app',
    component: CreateResearchTeamAdmins
  },
  {
    path: '/research-team-admins/edit/:id',
    name: 'Research Team Admins',
    icon: '',
    layout: '/app',
    component: EditResearchTeamAdmins
  },
  {
    path: '/research-team-admins/detail/:id',
    name: 'Research Team Admins',
    icon: '',
    layout: '/app',
    component: DetailResearchTeamAdmins
  },
  {
    path: '/research-teams/list',
    name: 'Research Teams',
    icon: '',
    layout: '/app',
    component: IndexResearchTeams
  },
  {
    path: '/research-teams/create',
    name: 'Research Team Admins',
    icon: '',
    layout: '/app',
    component: CreateResearchTeams
  },
  {
    path: '/research-teams/edit/:id',
    name: 'Research Team Admins',
    icon: '',
    layout: '/app',
    component: EditResearchTeams
  },
  {
    path: '/research-teams/detail/:id',
    name: 'Research Team Admins',
    icon: '',
    layout: '/app',
    component: DetailResearchTeams
  },
  // educational Institution Admin
  {
    path: '/educational-institution-admins/list',
    name: 'Educational Institution Admins',
    icon: '',
    layout: '/app',
    component: IndexEducationalInstitutionAdmins
  },
  {
    path: '/educational-institution-admins/create',
    name: 'Educational Institution Admins',
    icon: '',
    layout: '/app',
    component: CreateEducationalInstitutionAdmins
  },
  {
    path: '/educational-institution-admins/edit/:id',
    name: 'Educational Institution Admins',
    icon: '',
    layout: '/app',
    component: EditEducationalInstitutionAdmins
  },
  {
    path: '/educational-institution-admins/detail/:id',
    name: 'Educational Institution Admins',
    icon: '',
    layout: '/app',
    component: DetailEducationalInstitutionAdmins
  },
  // Educational Institutions
  {
    path : '/educational-institutions/list',
    name : 'Educational Institutions',
    icon : '',
    layout : '/app',
    component: IndexEducationalInstitutions
  },
  {
    path : '/educational-institutions/create',
    name : 'Educational Institutions',
    icon : '',
    layout : '/app',
    component: CreateEducationalInstitutions
  },
  {
    path : '/educational-institutions/edit/:id',
    name : 'Educational Institutions',
    icon : '',
    layout : '/app',
    component: EditEducationalInstitutions
  },
  {
    path : '/educational-institutions/detail/:id',
    name : 'Educational Institutions',
    icon : '',
    layout : '/app',
    component: DetailEducationalInstitutions
  },
  // Node Admin
  {
    path : '/node-admins/list',
    name : 'Node Admins',
    icon : '',
    layout : '/app',
    component: IndexNodeAdmins
  },
  {
    path : '/node-admins/create',
    name : 'Node Admins',
    icon : '',
    layout : '/app',
    component: CreateNodeAdmins
  },
  {
    path : '/node-admins/edit/:id',
    name : 'Node Admins',
    icon : '',
    layout : '/app',
    component: EditNodeAdmins
  },
  {
    path : '/node-admins/detail/:id',
    name : 'Node Admins',
    icon : '',
    layout : '/app',
    component: DetailNodeAdmins
  },
  // Node
  {
    path : '/nodes/list',
    name : 'Node',
    icon : '',
    layout : '/app',
    component: IndexNodes
  },
  {
    path : '/nodes/create',
    name : 'Node',
    icon : '',
    layout : '/app',
    component: CreateNodes
  },
  {
    path : '/nodes/edit/:id',
    name : 'Node',
    icon : '',
    layout : '/app',
    component: EditNodes
  },
  {
    path : '/nodes/detail/:id',
    name : 'Node',
    icon : '',
    layout : '/app',
    component: DetailNodes
  },
  // Research Lines
  {
    path : '/research-lines/list',
    name : 'Research-lines',
    icon : '',
    layout : '/app',
    component: IndexReasearchLines
  },
  {
    path : '/research-lines/create',
    name : 'Research-lines',
    icon : '',
    layout : '/app',
    component: CreateResearchLines
  },
  {
    path : '/research-lines/detail/:id',
    name : 'Research-Lines',
    icon : '',
    layout : '/app',
    component: DetailResearchLines
  },
  {
    path : '/research-lines/edit/:id',
    name : 'Research-Lines',
    icon : '',
    layout : '/app',
    component: EditResearchLines
  },
  // Research Groups
  {
    path : '/research-groups/list',
    name : 'Research-Groups',
    icon : '',
    layout : '/app',
    component: IndexResearchGroups
  },
  {
    path : '/research-groups/create',
    name : 'Research-Groups',
    icon : '',
    layout : '/app',
    component: CreateResearchGroups
  },
  {
    path : '/research-groups/detail/:id',
    name : 'Research-Groups',
    icon : '',
    layout : '/app',
    component: DetailResearchGroups
  },
  {
    path : '/research-groups/edit/:id',
    name : 'Research-Groups',
    icon : '',
    layout : '/app',
    component: EditResearchGroup
  },
  {
    path : '/knowledge-areas/list',
    name : 'Knowledge-Areas',
    icon : '',
    layout : '/app',
    component: IndexKnowledgeArea
  },
  {
    path : '/knowledge-areas/create',
    name : 'Knowledge-Areas',
    icon : '',
    layout : '/app',
    component: CreateKnowledgeArea
  },
  {
    path : '/knowledge-areas/detail/:id',
    name : 'Knowledge-Areas',
    icon : '',
    layout : '/app',
    component: DetailKnowledgeArea
  },
  {
    path : '/knowledge-areas/edit/:id',
    name : 'Knowledge-Areas',
    icon : '',
    layout : '/app',
    component: EditKnowledgeArea
  },
  // Academic Programs
  {
    path : '/academic-programs/list',
    name : 'Academic-programs',
    icon : '',
    layout : '/app',
    component: IndexAcademicProgram
  },
  {
    path : '/academic-programs/create',
    name : 'Academic-programs',
    icon : '',
    layout : '/app',
    component: CreateAcademicProgram
  },
  {
    path : '/academic-programs/detail/:id',
    name : 'Academic-programs',
    icon : '',
    layout : '/app',
    component: DetailAcademicProgram
  },
  {
    path : '/academic-programs/edit/:id',
    name : 'Academic-programs',
    icon : '',
    layout : '/app',
    component: EditAcademicProgram
  },
  
  // Educational Environments
  {
    path : '/educational-environments/list',
    name : 'Educational Environments',
    icon : '',
    layout : '/app',
    component: IndexEducationalEnvironments
  },
  {
    path : '/educational-environments/create',
    name : 'Educational Environments',
    icon : '',
    layout : '/app',
    component: CreateEducationalEnvironments
  },
  {
    path : '/educational-environments/edit/:id',
    name : 'Educational Environments',
    icon : '',
    layout : '/app',
    component: EditEducationalEnvironments
  },
  {
    path : '/educational-environments/detail/:id',
    name : 'Educational Environments',
    icon : '',
    layout : '/app',
    component: DetailEducationalEnvironments
  },
  // Loan request
  {
    path : '/educational-environments/loan-request',
    name : 'Educational Environments',
    icon : '',
    layout : '/app',
    component: IndexEducationalEnvironmentsLoanRequest
  },
  {
    path : '/educational-environments/check/:id',
    name : 'Educational Environments',
    icon : '',
    layout : '/app',
    component: CheckEducationalEnvironmentsLoanRequest
  },
  {
    path : '/educational-environments/request/:id',
    name : 'Educational Environments',
    icon : '',
    layout : '/app',
    component: CreateEducationalEnvironmentsLoanRequest
  },
  // Loan returns
  {
    path : '/educational-environments/loan-returns',
    name : 'Educational Environments',
    icon : '',
    layout : '/app',
    component: IndexEducationalEnvironmentsLoanReturn
  },
  {
    path : '/educational-environments/return-check/:id',
    name : 'Educational Environments',
    icon : '',
    layout : '/app',
    component: CheckEducationalEnvironmentsLoanReturn
  },
  // Educational Tool
  {
    path : '/educational-tools/list',
    name : 'Educational Tools',
    icon : '',
    layout : '/app',
    component: IndexEducationalTools
  },
  {
    path : '/educational-tools/create',
    name : 'Educational tools',
    icon : '',
    layout : '/app',
    component: CreateEducationalTools
  },
  {
    path : '/educational-tools/edit/:id',
    name : 'Educational tools',
    icon : '',
    layout : '/app',
    component: EditEducationalTools
  },
  {
    path : '/educational-tools/detail/:id',
    name : 'Educational tools',
    icon : '',
    layout : '/app',
    component: DetailEducationalTools
  },
  // Loan request
  {
    path : '/educational-tools/loan-request',
    name : 'Educational Tools',
    icon : '',
    layout : '/app',
    component: IndexEducationalToolLoanRequest
  },
  {
    path : '/educational-tools/check/:id',
    name : 'Educational Tools',
    icon : '',
    layout : '/app',
    component: CheckEducationalToolLoanRequest
  },
  {
    path : '/educational-tools/request/:id',
    name : 'Educational Tools',
    icon : '',
    layout : '/app',
    component: CreateEducationalToolLoanRequest
  },
  // Loan returns
  {
    path : '/educational-tools/loan-returns',
    name : 'Educational Tools',
    icon : '',
    layout : '/app',
    component: IndexEducationalToolsLoanReturn
  },
  {
    path : '/educational-tools/return-check/:id',
    name : 'Educational tools',
    icon : '',
    layout : '/app',
    component: CheckEducationalToolsLoanReturn
  },
];

export default routes;
