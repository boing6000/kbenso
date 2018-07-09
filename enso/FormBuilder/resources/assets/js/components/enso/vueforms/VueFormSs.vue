<template>

    <vue-form :data="data"
        :locale="locale"
        :params="params"
        v-if="data"
        ref="form">
        <template v-for="field in customFields"
            :slot="field.name"
            slot-scope="{ field, errors }">
            <slot :name="field.name"
                :field="field"
                :errors="errors"/>
        </template>
    </vue-form>

</template>

<script>

import VueForm from '../../../components/enso/vueforms/VueForm.vue';

export default {
    name: 'VueFormSs',

    components: { VueForm },

    props: {
        routeParams: {
            type: Array,
            required: true,
        },
        params: {
            type: Object,
            default: null,
        },
        locale: {
            type: String,
            default() {
                let locale = 'br';
                try {
                    locale = this.$store.preferences.global.lang;
                } catch (e) {}
                return locale;
            },
        },
    },

    data() {
        return {
            data: null,
            loading: false,
        };
    },

    computed: {
        customFields() {
            return this.data.sections
                .reduce((fields, section) => fields
                    .concat(section.fields.filter(field => field.meta.custom)), []);
        },
        saving() {
            return this.loading;
        }
    },

    created() {
        this.get();
    },

    methods: {
        get() {
            axios.get(route(...this.routeParams)).then(({ data }) => {
                this.data = data.form;
                this.$emit('loaded');
            }).catch(error => this.handleError(error));
        },
        field(field) {
            return this.data.sections
                .reduce((fields, section) => fields.concat(section.fields), [])
                .find(item => item.name === field);
        },
        back(){
            this.$refs.form.back();
        },
        submit() {
            this.$refs.form.submit();
        }
    },

};
</script>
