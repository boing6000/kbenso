import routeImporter from '../../../../../../../resources/assets/js/modules/importers/routeImporter';

const routes = routeImporter(require.context('./permissionGroups', false, /.*\.js$/));
import RouterView from '../../../../../../../resources/assets/js/pages/layout/Router.vue';

export default {
    path: 'permissionGroups',
    component: RouterView,
    meta: {
        breadcrumb: 'permissionGroups',
        route: 'system.permissionGroups.index',
    },
    children: routes,
};
