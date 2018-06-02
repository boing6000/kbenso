<template>

    <vue-table class="box"
        :path="path"
        id="permissionGroups">
    </vue-table>

</template>

<script>


export default {
    data() {
        return {
            path: route('system.permissionGroups.initTable'),
        };
    },
};

</script>
