import routeImporter from '../../../../../../../resources/assets/js/modules/importers/routeImporter';

const routes = routeImporter(require.context('./menus', false, /.*\.js$/));
import RouterView from '../../../../../../../resources/assets/js/pages/layout/Router.vue';

export default {
    path: 'menus',
    component: RouterView,
    meta: {
        breadcrumb: 'menus',
        route: 'system.menus.index',
    },
    children: routes,
};
