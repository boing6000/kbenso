import routeImporter from '../../../../../../../resources/assets/js/modules/importers/routeImporter';

const routes = routeImporter(require.context('./localisation', false, /.*\.js$/));
import RouterView from '../../../../../../../resources/assets/js/pages/layout/Router.vue';

export default {
    path: 'localisation',
    component: RouterView,
    meta: {
        breadcrumb: 'localisation',
        route: 'system.localisation.index',
    },
    children: routes,
};
