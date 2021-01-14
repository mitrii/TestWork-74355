<template>
    <tr :class="bgColor">
        <th scope="row">{{ car.id }}</th>
        <td style="cursor: pointer" @click="editData">
            <span v-show="!edit">{{ car.manufacturer }}</span>
            <input v-show="edit" v-model="manufacturer" />
        </td>
        <td style="cursor: pointer" @click="editData">
            <span v-show="!edit">{{ car.model }}</span>
            <input v-show="edit" v-model="model" />
        </td>
        <td style="cursor: pointer" @click="editData">
            <span v-show="!edit">{{ car.color }}</span>
            <input v-show="edit" v-model="color" />
        </td>
        <td style="cursor: pointer" @click="editData">
            <span v-show="!edit">{{ car.seatsCount }}</span>
            <input v-show="edit" v-model="seatsCount" />
        </td>
        <td>
            <button v-show="!edit" class="btn btn-danger" @click="destroy">Удалить</button>
            <button v-show="edit" class="btn btn-primary" @click="update">Сохранить</button>
            <button v-show="edit" class="btn btn-secondary" @click="cancelEdit">Оменить</button>
        </td>
    </tr>
</template>
<script>
export  default {
    props: ['car', 'status'],
    data () {
        return {
            edit: false,
            manufacturer: '',
            model: '',
            color: '',
            seatsCount: ''
        }
    },
    methods: {
        update(val) {
            this.$emit('update', this.car.id, {
                manufacturer: this.manufacturer,
                model: this.model,
                color: this.color,
                seatsCount: this.seatsCount
            })
        },
        destroy() {
            this.$emit('destroy', this.id)
        },
        editData() {
            this.manufacturer = this.car.manufacturer
            this.model = this.car.model
            this.color = this.car.color
            this.seatsCount = this.car.seatsCount

            this.edit = true
        },
        cancelEdit() {
            this.edit = false
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

            if (this.color === 'update') {
                return 'bg-secondary'
            }
        }
    },
    watch: {
        status(newValue) {
            console.log(newValue)
            if (typeof newValue === "undefined" || newValue === '') {
                this.edit = false
            }
        }
    }
}
</script>

<style>

</style>
