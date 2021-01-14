<template>
  <tr :class="bgColor">
    <th scope="row"></th>
        <td><input v-model="manufacturer" name="manufacturer" type="text" /></td>
        <td><input v-model="model" name="model" type="text" /></td>
        <td><input v-model="color" name="color" type="text" /></td>
        <td><input v-model="seatsCount" name="seatsCount" type="number" /></td>
    <td>
      <button class="btn btn-success" @click="create">Добавить</button>
    </td>
  </tr>
</template>
<script>
export default {
    name: 'car-create-component',
    props: ['status'],
    data() {
        return {
            manufacturer: '',
            model: '',
            color: '',
            seatsCount: ''
        }
    },
    methods: {
        create () {
            this.$emit('create', {
                manufacturer: this.manufacturer,
                model: this.model,
                color: this.color,
                seatsCount: this.seatsCount
            })
        },
        reset () {
            this.manufacturer = ''
            this.model = ''
            this.color = ''
            this.seatsCount = ''
        }
    },
    computed: {
        bgColor () {
            if (this.status === '') {
                return ''
            }

            if (this.status === 'error') {
                return 'bg-warning'
            }

            if (this.color === 'create') {
                return 'bg-secondary'
            }
        }
    },
    watch: {
        status(newValue) {
            if (newValue === '') {
                this.reset()
            }
        }
    }

}
</script>
