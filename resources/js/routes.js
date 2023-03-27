import HomeComponent from './components/pages/home/index';
import ConfigFunFinancieraComponent from './components/pages/config/ConfigFunFinancieraComponent';
import ConfigFunPlaneacionComponent from './components/pages/config/ConfigFunPlaneacionComponent';
import ConfigFunVistoBuenoComponent from './components/pages/config/ConfigFunVistoBuenoComponent';

import PAAYear from './components/pages/paa/PAAYear';
import PAAYearForm from './components/pages/paa/PAAYearForm';

import PAA from './components/pages/paa/PAA';
import PAAForm from './components/pages/paa/PAAForm';
import PAALineForm from './components/pages/paa/PAALineForm';


export const routes = [
    {
        path: '/',
        component: HomeComponent
    },
    {
        path: '/configurar/funcionario-financiera',
        component: ConfigFunFinancieraComponent
    },
    {
        path: '/configurar/funcionario-planeacion',
        component: ConfigFunPlaneacionComponent
    },
    {
        path: '/configurar/funcionario-visto-bueno',
        component: ConfigFunVistoBuenoComponent
    },
    {
        path: '/paa/years',
        component: PAAYear,
        name:'paa-years'
    },
    {
        path: '/paa/years/new',
        component: PAAYearForm,
        name:'paa-years-new'
    },
    {
        path: '/paa/years/edit/:id',
        component: PAAYearForm,
        name:'paa-years-edit'
    },
    {
        path: '/paas',
        component: PAA,
        name:'paas'
    },
    {
        path: '/paas/edit/:id',
        component: PAAForm,
        name:'paas-edit'
    },
    {
        path: '/paas/new',
        component: PAAForm,
        name:'paas-new'
    },
    {
        path: '/paas/:id/lines/new',
        component: PAALineForm,
        name:'paas-line-new'
    },
    {
        path: '/paas/:id/lines/edit/:lineId',
        component: PAALineForm,
        name:'paas-line-edit'
    },
];
