<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица производителей</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Добавить производителя  <i class="fas fa-industry"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>производитель</th>
                                <th>Редоктирование</th>
                            </tr>

                            <tr v-for="manufacturer in manufacturers.data" :key="manufacturer.id">
                                <td>{{ manufacturer.id }}</td>
                                <td>{{ manufacturer.manufacturer }}</td>

                                <td>
                                    <a href="">
                                        <i class="fa fa-edit" @click.prevent="editModal(manufacturer)" data-toggle="modal" data-target="#editManufacturer" ></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="fa fa-trash" @click.prevent="deleteManufacturer(manufacturer.id)"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="manufacturers" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.row -->

        <!-- Modal -->
        <div class="modal fade" id="addManufacturer" tabindex="-1" role="dialog" aria-labelledby="addManufacturerLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="addManufacturerLabel">Добавить производителя</h5>
                        <h5 v-show="editmode" class="modal-title" id="editManufacturerLabel">Изменить производителя</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateManufacturer() : createManufacturer()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.manufacturer" type="text" name="manufacturer"  class="form-control" placeholder="manufacturer" :class="{ 'is-invalid':form.errors.has('manufacturer') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Добавить производителя</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Изменить производителя</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                editmode:true,
                manufacturers: {},
                form: new Form({
                    id: '',
                    manufacturer: '',

                })
            }
        },
        methods: {

            getResults(page = 1) {
                axios.get('/api/manufacturer/?page=' + page)
                    .then(response => {
                        this.manufacturers = response.data;
                    });
            },

            loadManufacturers(){
                axios.get('/api/manufacturer')
                    .then(({data}) =>
                        (this.manufacturers = data));
            },

            updateManufacturer(){

                this.form.put('/api/manufacturer/'+ this.form.id)
                    .then(()=>{
                        $('#addManufacturer').modal('hide');
                        swal.fire(
                            'Изменено!',
                            'Производитель успешно изменён.',
                            'success'
                        )
                        this.$emit('AfterCreate');
                    })
                    .catch((data)=> {
                        console.log(data);
                        swal(
                            'Ошибка!',
                            'Что то пошло не так.',
                            'warning'
                        )
                    })
            },

            editModal(manufacturer){
                this.editmode = true;
                this.form.reset();
                $('#addManufacturer').modal('show');
                this.form.fill(manufacturer);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addManufacturer').modal('show');
            },



            createManufacturer(){

                this.form.post('/api/manufacturer')
                    .then(()=>{
                        this.$emit('AfterCreate');
                        $('#addManufacturer').modal('hide');
                        swal.fire({
                            type: 'success',
                            title: 'Производитель успешно создан'
                        })
                    })

            },

            deleteManufacturer(id){

                swal.fire({
                    title: 'Вы уверены?',
                    text: "Производитель будет удалён",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить!',
                    cancelButtonText: 'Отмена'
                }).then((result) => {


                    if (result.value) {
                        this.form.delete('/api/manufacturer/'+id)
                            .then(()=>{

                                swal.fire(
                                    'Удалено!',
                                    'Производить удалён успешно.',
                                    'success'
                                )

                                this.$emit('AfterCreate');

                            })
                            .catch((data)=>{
                                console.log(data);
                                swal(
                                    'Ошибка!',
                                    'Что то пошло не так.',
                                    'warning'
                                )
                            })
                    }
                })
            },

        },
        mounted() {
            Fire.$on('searching', () => {
            let query = this.$parent.search;
            axios.get('/api/findManufacturer?q=' + query)
                .then((data)=>{
                    this.manufacturers = data.data;
                })
                .catch(()=>{

                })
        });
            this.loadManufacturers();
            this.$on('AfterCreate', () => {
                this.loadManufacturers();
            })
        }
    }
</script>
