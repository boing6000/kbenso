<template>

    <vue-form :data="data" @saving="initForm($event)"
        :locale="$store.state.user.preferences.global.lang"
        v-if="data"
        ref="form">
        <template v-for="field in customFields"
            :slot="field.name"
            slot-scope="{ field, errors }">
            <slot :name="field.name"
                :field="field"
                :errors="errors">
            </slot>
        </template>
    </vue-form>

</template>

<script>

import VueForm from '../../../components/enso/vueforms/VueForm.vue';

export default {
    name: 'VueFormSs',

    components: { VueForm },

    props: {
        params: {
            type: Array,
            required: true,
        },
        locale: {
            type: String,
            default() {
                let locale = 'br';
                try {
                    locale = this.$store.state.user.preferences.global.lang;
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
        axios.get(route(...this.params)).then((res) => {
            let data = res.data;
            this.data = data.form;
            this.$emit('loaded');
        }).catch(error => this.handleError(error));
    },

    methods: {
        initForm($event) {
            this.loading = $event;
        },
        field(field) {
            return this.data.sections
                .reduce((fields, section) => fields.concat(section.fields), [])
                .find(item => item.name === field);
        },
        section(section) {
            return this.data.sections
                .find(item => item.title === section);
        },
        formData() {
            return this.data.sections
                .reduce((fields, section) => fields
                    .concat(section.fields), [])
                .reduce((object, field) => {
                    object[field.name] = field.value;
                    return object;
                }, { _params: this.params });
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
