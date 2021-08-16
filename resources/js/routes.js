import Dashboard from './components/home/Index';
import Grid from './components/home/Grid';

export const routes = [
    {
        path: '/home',
        name: 'Dashboard',
        component: Dashboard
    },
    {
        path:'/home/Grid',
        name:'Grid',
        component:Grid
    }
];
