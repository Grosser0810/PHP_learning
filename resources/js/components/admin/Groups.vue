<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Groups Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add Group <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Group Name</th>
                                <th>Action</th>
                            </tr>

                            <tr v-for="group in groups.data" :key="group.id">
                                <td>{{ group.id }}</td>
                                <td>{{ group.group }}</td>

                                <td>
                                    <a href="">
                                        <i class="fa fa-edit" @click.prevent="editModal(group)" data-toggle="modal" data-target="#editGroup" ></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="fa fa-trash" @click.prevent="deleteGroup(group.id)"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <pagination :data="groups" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.row -->

        <!-- Modal -->
        <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="addGroupLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="addGroupLabel">Add Group</h5>
                        <h5 v-show="editmode" class="modal-title" id="editGroupLabel">Update Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateGroup() : createGroup()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.group" type="text" name="group"  class="form-control" placeholder="Group" :class="{ 'is-invalid':form.errors.has('group') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create Group</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update Group</button>
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
                groups: {},
                form: new Form({
                    id: '',
                    group: '',

                })
            }
        },
        methods: {

            getResults(page = 1) {
                axios.get('/api/group/?page=' + page)
                    .then(response => {
                        this.groups = response.data;
                    });
            },

            loadGroups(){
                axios.get('/api/group')
                    .then(({data}) =>
                        (this.groups = data));
            },

            updateGroup(){

                this.form.put('/api/group/'+ this.form.id)
                    .then(()=>{
                        $('#addGroup').modal('hide');
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

            editModal(group){
                this.editmode = true;
                this.form.reset();
                $('#addGroup').modal('show');
                this.form.fill(group);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addGroup').modal('show');
            },



            createGroup(){
                this.$Progress.start();
                this.form.post('/api/group')
                    .then(()=>{
                        this.$emit('AfterCreate');
                        $('#addGroup').modal('hide');
                        swal.fire({
                            type: 'success',
                            title: 'Group Created successfully'
                        })
                    })

            },

            deleteGroup(id){

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
                        this.form.delete('/api/group/'+id)
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
                axios.get('/api/findGroup?q=' + query)
                    .then((data)=>{
                        this.groups = data.data;
                    })
                    .catch(()=>{

                    })
            });
            this.loadGroups();
            this.$on('AfterCreate', () => {
                this.loadGroups();
            })
        }
    }
</script>
