<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица Превью</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Добавить превью<i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>

                            </tr>

                            <tr v-for="preview in previews.data" :key="preview.id">
                                <td>{{ preview.id }}</td>
                                <td>{{ preview.title }}</td>
                                <td>{{ preview.description }}</td>

                                <td>
                                    <a href="">
                                        <i class="fa fa-edit" @click.prevent="editModal(preview)" data-toggle="modal" data-target="#editPreview" ></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="fa fa-trash" @click.prevent="deletePreview(preview.id)"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <!--<div class="card-footer">
                        <pagination :data="products" @pagination-change-page="getResults"></pagination>
                    </div>-->
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.row -->

        <!-- Modal -->
        <div class="modal fade" id="addPreview" tabindex="-1" role="dialog" aria-labelledby="addPreviewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="addPreviewLabel">Добавить превью</h5>
                        <h5 v-show="editmode" class="modal-title" id="editPreviewLabel">Изменить превью</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updatePreview() : createPreview()" >
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.title" type="text" name="title"  class="form-control" placeholder="Title" :class="{ 'is-invalid':form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.description" type="text" name="description"  class="form-control" placeholder="description" :class="{ 'is-invalid':form.errors.has('description') }">
                                <has-error :form="form" field="description"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Создать превью</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Изменить превью</button>
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
                previews: {},
                form: new Form({
                    id: '',
                    title: '',
                    description: '',

                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('/api/preview/?page=' + page)
                    .then(response => {
                        this.previews = response.data;
                    });
            },

            loadPreviews(){
                axios.get('/api/preview')
                    .then(({data}) =>
                        (this.previews = data));

            },
            editModal(preview){
                this.editmode = true;
                this.form.reset();
                $('#addPreview').modal('show');
                this.form.fill(preview);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addPreview').modal('show');
            },

            updatePreview(){
                this.form.put('/api/preview/'+ this.form.id)
                    .then(()=>{
                        $('#addPreview').modal('hide');
                        swal.fire(
                            'Updated!',
                            'Your file has been updated.',
                            'success'
                        )

                        this.$emit('AfterCreate');
                    })
                    .catch((data)=> {

                        console.log(data);
                        swal(
                            'Failed!',
                            'There was something wrong.',
                            'warning'
                        )
                    })
            },

            createPreview(){

                this.form.post('/api/preview')
                    .then(()=>{

                        this.$emit('AfterCreate');
                        $('#addPreview').modal('hide');
                        swal.fire({
                            type: 'success',
                            title: 'Preview Created successfully'
                        })
                    })
                    .catch(()=>{

                    })

            },

            deletePreview(id){

                swal.fire({
                    title: 'Вы уверены?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('/api/preview/'+id)
                            .then(()=>{
                                swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                )

                                this.$emit('AfterCreate');

                            })
                            .catch((data)=>{
                                console.log(data);
                                swal(
                                    'Failed!',
                                    'There was something wrong.',
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
                axios.get('/api/findPreview?q=' + query)
                    .then((data)=>{
                        this.previews = data.data;
                    })
                    .catch(()=>{

                    })
            });
            this.loadPreviews();
            this.$on('AfterCreate', () => {
                this.loadPreviews();
            })

        }
    }
</script>