import routeImporter from '../../../../../../../resources/assets/js/modules/importers/routeImporter';

const routes = routeImporter(require.context('./permissions', false, /.*\.js$/));
import RouterView from '../../../../../../../resources/assets/js/pages/layout/Router.vue';


export default {
    path: 'permissions',
    component: RouterView,
    meta: {
        breadcrumb: 'permissions',
        route: 'system.permissions.index',
    },
    children: routes,
};
