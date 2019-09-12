<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица пользователей</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Добавить пользовател <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Имя</th>
                                <th>Email</th>
                                <th>Тип</th>
                                <th>Создан</th>
                                <th>Редактирование</th>
                            </tr>

                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{ user.id }}</td>
                                <td>{{ user.name }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.type }}</td>
                                <td>{{ user.created_at }}</td>
                                <td>
                                    <a href="">
                                        <i class="fa fa-edit" @click.prevent="editModal(user)" data-toggle="modal" data-target="#editUser" ></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="fa fa-trash" @click.prevent="deleteUser(user.id)"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="users" @pagination-change-page="getResults"></pagination>
                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.row -->

        <!-- Modal -->
        <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="addUserLabel">Добавить пользователя</h5>
                        <h5 v-show="editmode" class="modal-title" id="editUserLabel">Изменить пользователя</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name"  class="form-control" placeholder="Name" :class="{ 'is-invalid':form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email"  class="form-control" placeholder="Email Address" :class="{ 'is-invalid':form.errors.has('email') }" value="">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.bio" type="text" name="bio"  class="form-control" placeholder="Bio" :class="{ 'is-invalid':form.errors.has('bio') }">
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="type" v-model="form.type" id="type"  class="form-control" :class="{ 'is-invalid':form.errors.has('type') }">
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>

                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password" class="form-control" placeholder="Password" :class="{ 'is-invalid':form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Добавить пользователя</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Изменить пользователя</button>
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
                users: {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo:''
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('/api/user/?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },

            updateUser(){

                this.form.put('/api/user/'+ this.form.id)
                    .then(()=>{
                        $('#addUser').modal('hide');
                        swal.fire(
                            'Изменен!',
                            'Пользователь успешно изменен.',
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

            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addUser').modal('show');
                this.form.fill(user);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addUser').modal('show');
            },


            loadUsers(){
                axios.get('/api/user')
                    .then(({data}) =>
                        (this.users = data));
            },

            createUser(){

                this.form.post('/api/user')
                    .then(()=>{
                        this.$emit('AfterCreate');
                        $('#addUser').modal('hide');
                        swal.fire({
                            type: 'success',
                            title: 'Пользователь успешно создан'
                        })
                    })
                    
            },

            deleteUser(id){

                swal.fire({
                    title: 'Вы уверены?',
                    text: "Пользователь будет удален!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить!',
                    cancelButtonText: 'Отмена'
                }).then((result) => {


                    if (result.value) {
                        this.form.delete('/api/user/'+id)
                            .then(()=>{

                                swal.fire(
                                    'Удален!',
                                    'Пользователь успешно удален.',
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
                axios.get('/api/findUser?q=' + query)
                .then((data)=>{
                    this.users = data.data;
                })
                .catch(()=>{

                })
            });
            this.loadUsers();
            Fire.$on('AfterCreate', () => {
                this.loadUsers();
            })

        }
    }
</script>










