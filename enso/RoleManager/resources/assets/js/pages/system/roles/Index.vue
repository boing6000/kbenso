<template>

    <vue-table class="box"
        :path="path"
        id="roles"
        @configure-role="redirect">
    </vue-table>

</template>

<script>


export default {

    data() {
        return {
            path: route('system.roles.initTable', [], false),
        };
    },

    methods: {
        redirect($event) {
            this.$router.push({
                name: 'system.roles.configure',
                params: { role: $event.dtRowId },
            });
        },
    },
};

</script>
