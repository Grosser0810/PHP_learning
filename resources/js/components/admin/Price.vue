<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица Прайс-лист</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Добавить прайс<i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Услуга</th>
                                <th>Стоимость</th>
                                <th>Редактирование</th>
                            </tr>

                            <tr v-for="price in prices.data" :key="price.id">
                                <td>{{ price.id }}</td>
                                <td>{{ price.title }}</td>
                                <td>{{ price.cost }}</td>

                                <td>
                                    <a href="">
                                        <i class="fa fa-edit" @click.prevent="editModal(price)" data-toggle="modal" data-target="#editPrice" ></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="fa fa-trash" @click.prevent="deletePrice(price.id)"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <pagination :data="prices" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.row -->

        <!-- Modal -->
        <div class="modal fade" id="addPrice" tabindex="-1" role="dialog" aria-labelledby="addPriceLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="addPriceLabel">Добавить прайс</h5>
                        <h5 v-show="editmode" class="modal-title" id="editPriceLabel">Изменить прайс</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updatePrice() : createPrice()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.title" type="text" name="title"  class="form-control" placeholder="Название услуги" :class="{ 'is-invalid':form.errors.has('title') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.cost" type="text" name="cost"  class="form-control" placeholder="Стоимость услуги" :class="{ 'is-invalid':form.errors.has('cost') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Создать прайс</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Изменить прайс</button>
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
                prices: {},
                form: new Form({
                    id: '',
                    title: '',
                    cost: '',

                })
            }
        },
        methods: {

            getResults(page = 1) {
                axios.get('/api/group/?page=' + page)
                    .then(response => {
                        this.prices = response.data;
                    });
            },

            loadPrices(){
                axios.get('/api/price')
                    .then(({data}) =>
                        (this.prices = data));
            },

            updatePrice(){

                this.form.put('/api/price/'+ this.form.id)
                    .then(()=>{
                        $('#addPrice').modal('hide');
                        swal.fire(
                            'Изменено!',
                            'Прайс успешно изменен.',
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

            editModal(price){
                this.editmode = true;
                this.form.reset();
                $('#addPrice').modal('show');
                this.form.fill(price);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addPrice').modal('show');
            },



            createPrice(){
                this.form.post('/api/price')
                    .then(()=>{
                        this.$emit('AfterCreate');
                        $('#addPrice').modal('hide');
                        swal.fire({
                            type: 'success',
                            title: 'Group Created successfully'
                        })
                    })
            },

            deletePrice(id){

                swal.fire({
                    title: 'Вы уверены?',
                    text: "Прайс будет удален!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить!',
                    cancelButtonText: 'Отмена'
                }).then((result) => {


                    if (result.value) {
                        this.form.delete('/api/price/'+id)
                            .then(()=>{

                                swal.fire(
                                    'Удалено!',
                                    'Прайс успешно удален.',
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

            this.loadPrices();
            this.$on('AfterCreate', () => {
                this.loadPrices();
            })
        }
    }
</script>
