<template>
    <tr>
        <th scope="row">{{ id }}</th>
        <td>{{ manufacturer }}</td>
        <td>{{ modelName }}</td>
        <td>{{ color }}</td>
        <td>{{ seatsCount }}</td>
        <td><button class="btn btn-danger" @click="destroy">Удалить</button></td>
    </tr>
</template>
<script>
export  default {
    props: ['id', 'manufacturer', 'model', 'color', 'seatsCount'],
    computed: {
        modelName() {
            return this.model
        }
    },
    methods: {
        update(val) {
            this.$emit('update', this.id, val)
        },
        destroy() {
            this.$emit('destroy', this.id)
        }
    },
}
</script>

<style>

</style>
