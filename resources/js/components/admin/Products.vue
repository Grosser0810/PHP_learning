<style>
    #productImg {
        width:  100px;
        height: 100px;
        box-shadow: #555555 0px 0px 10px;
    }

</style>
<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Add Product <i class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Stock</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Composition</th>
                                <th>Group</th>
                                <th>Manufacturer</th>
                            </tr>

                            <tr v-for="product in products.data" :key="product.id">
                                <td>{{ product.id }}</td>
                                <td>{{ product.title }}</td>

                                <td>
                                   <img class="img-circle" id="productImg" :src="getSrc(product.image)" alt="">
                                </td>
                                <td>{{ product.stock }}</td>
                                <td>{{ product.code }}</td>
                                <td>{{ product.description }}</td>
                                <td>{{ product.price }}</td>
                                <td>{{ product.composition }}</td>
                                <td>{{ product.group_id }}</td>
                                <td>{{ product.manufacturer_id }}</td>
                                <td>
                                    <a href="">
                                        <i class="fa fa-edit" @click.prevent="editModal(product)" data-toggle="modal" data-target="#editProduct" ></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="fa fa-trash" @click.prevent="deleteProduct(product.id)"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="products" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div><!-- /.row -->

        <!-- Modal -->
        <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProductLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="addProductLabel">Add Product</h5>
                        <h5 v-show="editmode" class="modal-title" id="editProductLabel">Update Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateProduct() : createProduct()" >
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.title" type="text" name="title"  class="form-control" placeholder="Title" :class="{ 'is-invalid':form.errors.has('title') }">
                                <has-error :form="form" field="title"></has-error>
                            </div>
                            <div class="form-group">
                                <input  type="file" @change="pushImage" name="image"  class="form-control" placeholder="" value="">
                                <has-error :form="form" field="image"></has-error>
                            </div>
                            <div class="form-group">
                                <select name="stock" v-model="form.stock" id="stock"  class="form-control" :class="{ 'is-invalid':form.errors.has('stock') }">
                                    <option value="">Select Stock</option>
                                    <option value="In stock">В наличии</option>
                                    <option value="not available">Нет в наличии</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.code" type="text" name="code"  class="form-control" placeholder="Code" :class="{ 'is-invalid':form.errors.has('code') }">
                                <has-error :form="form" field="code"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.description" type="text" name="description"  class="form-control" placeholder="description" :class="{ 'is-invalid':form.errors.has('description') }">
                                <has-error :form="form" field="description"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.price" type="text" name="price"  class="form-control" placeholder="Price" :class="{ 'is-invalid':form.errors.has('price') }">
                                <has-error :form="form" field="price"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.composition" type="text" name="composition"  class="form-control" placeholder="Composition" :class="{ 'is-invalid':form.errors.has('composition') }">
                                <has-error :form="form" field="composition"></has-error>
                            </div>

                            <div class="form-group">
                                <select  name="group_id" v-model="form.group_id" class="form-control" :class="{ 'is-invalid':form.errors.has('group_id') }">
                                    <option value="">выберите группу</option>
                                    <option v-for="group in groups" :value="group.id">{{group.group}}</option>

                                </select>
                                <has-error :form="form" field="group_id"></has-error>
                            </div>

                            <div class="form-group">
                                <select name="manufacturer_id" v-model="form.manufacturer_id" id="manufacturer_id"  class="form-control" :class="{ 'is-invalid':form.errors.has('manufacturer_id') }">
                                    <option value="">Select Manufacturer</option>
                                    <option v-for="manufacturer in manufacturers" :value="manufacturer.id">{{manufacturer.manufacturer}}</option>


                                </select>
                                <has-error :form="form" field="manufacturer_id"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create Product</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update Product</button>
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
                products: {},
                groups: [],
                manufacturers: [],
                form: new Form({
                    id: '',
                    title: '',
                    image: '',
                    stock: '',
                    code: '',
                    description: '',
                    price:'',
                    composition:'',
                    group_id:'',
                    manufacturer_id:'',
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('/api/product/?page=' + page)
                    .then(response => {
                        this.products = response.data;
                    });
            },

            loadProducts(){
                axios.get('/api/product')
                    .then(({data}) =>
                        (this.products = data));

            },

            loadGroups(){
                axios.get('/api/loadGroup')
                    .then((response) => {
                        this.groups = response.data})
                    .catch((error)=> {
                        console.log(error)
                    })
            },
            loadManufacturers(){
                axios.get('/api/loadManufacturer')
                    .then((response) => {
                        this.manufacturers = response.data})
                    .catch((error)=> {
                        console.log(error)
                    })
            },

            getSrc(img){
                let image = "/img/product/" + img;
                return image;
            },

            pushImage (e){
                console.log('da');
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onloadend = (file)=> {

                    this.form.image = reader.result;
                }
                reader.readAsDataURL(file);
            },

            editModal(product){
                this.editmode = true;
                this.form.reset();
                $('#addProduct').modal('show');
                this.form.fill(product);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addProduct').modal('show');
            },


            updateProduct(){


                this.form.put('/api/product/'+ this.form.id)
                    .then(()=>{
                        $('#addProduct').modal('hide');
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

            createProduct(){

                this.form.post('/api/product')
                    .then(()=>{

                        this.$emit('AfterCreate');
                        $('#addProduct').modal('hide');
                        swal.fire({
                            type: 'success',
                            title: 'Product Created successfully'
                        })
                    })
                    .catch(()=>{

                })

            },

            deleteProduct(id){

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
                        this.form.delete('/api/product/'+id)
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
                axios.get('/api/findProduct?q=' + query)
                    .then((data)=>{
                        this.products = data.data;
                    })
                    .catch(()=>{

                    })
            });
            this.loadGroups();
            this.loadManufacturers();
            this.loadProducts();
            this.$on('AfterCreate', () => {
                this.loadProducts();
            })

        }
    }
</script>










