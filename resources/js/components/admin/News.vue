<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица новостей</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Добавить новость <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Заголовок</th>
                                <th>Новость</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="post in news.data" :key="post.id">
                                <td>{{ post.id }}</td>
                                <td>{{ post.title }}</td>
                                <td>{{ post.text }}</td>

                                <td>
                                    <a href="">
                                        <i class="fa fa-edit" @click.prevent="editModal(post)" data-toggle="modal" data-target="#editNews" ></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="fa fa-trash" @click.prevent="deleteNews(post.id)"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <pagination :data="news" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.row -->

        <!-- Modal -->
        <div class="modal fade" id="addNews" tabindex="-1" role="dialog" aria-labelledby="addNewsLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="addNewsLabel">Добавить новость</h5>
                        <h5 v-show="editmode" class="modal-title" id="editNewsLabel">Изменить новость</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateNews() : createNews()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.title" type="text" name="title"  class="form-control" placeholder="Заголовок" :class="{ 'is-invalid':form.errors.has('title') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <textarea v-model="form.text" type="text" name="text"  class="form-control" placeholder="Текст новости" :class="{ 'is-invalid':form.errors.has('group') }" cols="30" rows="10"></textarea>
                                <has-error :form="form" field="name"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Создать новость</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Изменит новость</button>
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
                news: {},
                form: new Form({
                    id: '',
                    title: '',
                    text: '',

                })
            }
        },
        methods: {

            getResults(page = 1) {
                axios.get('/api/news/?page=' + page)
                    .then(response => {
                        this.news = response.data;
                    });
            },

            loadNews(){
                axios.get('/api/news')
                    .then(({data}) =>
                        (this.news = data));
            },

            updateNews(){

                this.form.put('/api/news/'+ this.form.id)
                    .then(()=>{
                        $('#addNews').modal('hide');
                        swal.fire(
                            'Изменено!',
                            'Новость успешно изменена.',
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

            editModal(post){
                this.editmode = true;
                this.form.reset();
                $('#addNews').modal('show');
                this.form.fill(post);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNews').modal('show');
            },



            createNews(){

                this.form.post('/api/news')
                    .then(()=>{
                        this.$emit('AfterCreate');
                        $('#addNews').modal('hide');
                        swal.fire({
                            type: 'success',
                            title: 'Новость успешно создана'
                        })
                    })

            },

            deleteNews(id){

                swal.fire({
                    title: 'Вы уверены?',
                    text: "Новость будет удалена!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить!',
                    cancelButtonText: 'Отмена'
                }).then((result) => {


                    if (result.value) {
                        this.form.delete('/api/news/'+id)
                            .then(()=>{

                                swal.fire(
                                    'Удалено!',
                                    'Новость успешно удалена.',
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
                axios.get('/api/findNews?q=' + query)
                    .then((data)=>{
                        this.news = data.data;
                    })
                    .catch(()=>{

                    })
            });
            this.loadNews();
            this.$on('AfterCreate', () => {
                this.loadNews();
            })
        }
    }
</script>
