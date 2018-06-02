<template>

    <vue-table class="box"
        :path="path"
        id="permissions">
        <span slot="type"
            slot-scope="{ row }"
            :class="[
                'tag is-table-tag',
                row.isRead ? 'is-success' : 'is-warning'
            ]">
                {{ row['type'] }}
        </span>
    </vue-table>

</template>

<script>


export default {
    data() {
        return {
            path: route('system.permissions.initTable'),
        };
    },
};

</script>
