<template>

        <vue-table class="box"
            :path="path"
            id="menus">
        </vue-table>

</template>

<script>


export default {

    data() {
        return {
            path: route('system.menus.initTable'),
        };
    },
};

</script>
