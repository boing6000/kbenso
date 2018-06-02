<template>

    <vue-table class="box"
        :path="path"
        id="localisation">
        <i slot="flag"
            slot-scope="{ row, column }"
            :class="row['flag']">
        </i>
    </vue-table>

</template>

<script>

import fontawesome from '@fortawesome/fontawesome';
import { faEdit } from '@fortawesome/fontawesome-free-solid/shakable.es';

fontawesome.library.add(faEdit);

export default {
    data() {
        return {
            path: route('system.localisation.initTable', [], false),
        };
    },
};

</script>
