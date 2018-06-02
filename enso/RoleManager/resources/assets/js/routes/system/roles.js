import routeImporter from '../../../../../../../resources/assets/js/modules/importers/routeImporter';

const routes = routeImporter(require.context('./roles', false, /.*\.js$/));
import RouterView from '../../../../../../../resources/assets/js/pages/layout/Router.vue';


export default {
    path: 'roles',
    component: RouterView,
    meta: {
        breadcrumb: 'roles',
        route: 'system.roles.index',
    },
    children: routes,
};
