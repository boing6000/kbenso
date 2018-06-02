<template>

    <div class="columns is-centered">
        <div class="column is-three-quarters">
            <vue-form-ss class="box animated fadeIn"
                :params="[$route.name, $route.params.id, false]">
            </vue-form-ss>
        </div>
    </div>

</template>

<script>


export default {
};

</script>
