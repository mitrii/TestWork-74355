<template>
    <div id="app">
        <div class="heading">
            <h1>Cars</h1>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Manufacturer</th>
                <th scope="col">Model</th>
                <th scope="col">Color</th>
                <th scope="col">Seats Count</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <car-component
                v-for="car in cars"
                :car="car"
                :key="car.id"
                @update="update"
                @destroy="destroy"
                :status="updateStatuses[car.id]"
            />
            <car-create-component @create="create" :status="createStatus"/>
            </tbody>
        </table>
    </div>
</template>

<script>
import CarComponent from "./components/CarComponent";
import CarCreateComponent from "./components/CarCreateComponent";
import Vue from 'vue'

export default {
    name: "App.vue",
    components: {CarCreateComponent, CarComponent},
    comments: { CarComponent },
    data() {
        return {
            cars: [],
            createStatus: '',
            updateStatuses: {}
        }
    },
    methods: {
        create(data) {
            this.createStatus = 'create'
            window.axios.post('/api/car', data)
                .then(response => {
                    if (response.status === 201) {
                        this.cars.push(response.data)
                        this.createStatus = ''
                    } else {
                        this.createStatus = 'error'
                    }
                })
                .catch(() => {
                    this.createStatus = 'error'
                })
        },
        read() {
            window.axios.get('/api/car')
                .then(response => {
                    this.cars = response.data
                });
        },
        update(id, data) {
            Vue.set(this.updateStatuses, id, 'update')
            window.axios.put(`/api/car/${id}`, data)
                .then(response => {
                    const index = this.cars.findIndex(car => car.id === id);
                    Vue.set(this.cars, index, response.data)
                    Vue.set(this.updateStatuses, id, '')
                })
                .catch(() => {
                    Vue.set(this.updateStatuses, id, 'error')
                })
        },
        destroy(id) {
            window.axios.delete(`/api/car/${id}`)
            .then(response => {
                if (response.status === 204) {
                    const index = this.cars.findIndex(car => car.id === id);
                    this.cars.splice(index, 1);
                }
            });
        }
    },
    created() {
        this.read();
    }
}
</script>

