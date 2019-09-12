
<template>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Таблица Слайдов</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" @click="newModal">Добавить слайд <i class="nav-icon fas fa-tachometer-alt"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Картинка</th>
                                <th>Редоктирование</th>
                            </tr>
                            <tr v-for="slide in slides.data" :key="slide.id">
                                <td>{{ slide.id }}</td>
                                <td>
                                    <img id="slideImg" width="300px" height="200px" :src="getSrc(slide.image)" alt="">
                                </td>
                                <td>
                                    <a href="">
                                        <i class="fa fa-edit" @click.prevent="editModal(slide)" data-toggle="modal" data-target="#editProduct" ></i>
                                    </a>
                                    |
                                    <a href="">
                                        <i class="fa fa-trash" @click.prevent="deleteSlide(slide.id)"></i>
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="card-footer">
                        <pagination :data="slides" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal fade" id="addSlide" tabindex="-1" role="dialog" aria-labelledby="addSlideLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 v-show="!editmode" class="modal-title" id="addSlideLabel">Добавить слайд</h5>
                        <h5 v-show="editmode" class="modal-title" id="editSlideLabel">Изменить слайд</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateSlide() : createSlide()" >
                        <div class="modal-body">

                            <div class="form-group">
                                <input  type="file" @change="pushImage" name="image"  class="form-control" placeholder="" value="">
                                <has-error :form="form" field="image"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Добавить слайд</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Изменить слайд</button>
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
                slides: {},
                form: new Form({
                    id: '',
                    image: '',
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('/api/carousel/?page=' + page)
                    .then(response => {
                        this.slides = response.data;
                    });
            },

            loadSlides(){
                axios.get('/api/carousel')
                    .then(({data}) =>
                        (this.slides = data));

            },

            getSrc(img){
                let image = "/img/carousel/" + img;
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

            editModal(slide){
                this.editmode = true;
                this.form.reset();
                $('#addSlide').modal('show');
                this.form.fill(slide);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addSlide').modal('show');
            },

            updateSlide(){
                this.form.put('/api/carousel/'+ this.form.id)
                    .then(()=>{
                        $('#addSlide').modal('hide');
                        swal.fire(
                            'Изменено!',
                            'Ваш файл был обновлен.',
                            'success'
                        )

                        this.$emit('AfterCreate');
                    })
                    .catch((data)=> {

                        console.log(data);
                        swal(
                            'Ошибка!',
                            'Что то пошло не так',
                            'warning'
                        )
                    })
            },

            createSlide(){

                this.form.post('/api/carousel')
                    .then(()=>{

                        this.$emit('AfterCreate');
                        $('#addSlide').modal('hide');
                        swal.fire({
                            type: 'success',
                            title: 'Слайд успешно добавлен'
                        })
                    })
                    .catch(()=>{

                    })
            },

            deleteSlide(id){

                swal.fire({
                    title: 'Вы уверены?',
                    text: "Слайд будет окончательно удален",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить!',
                    cancelButtonText: 'Отмена'
                }).then((result) => {
                    if (result.value) {
                        this.form.delete('/api/carousel/'+id)
                            .then(()=>{
                                swal.fire(
                                    'Удалён!',
                                    'Ваш файл был удален',
                                    'success'
                                )

                                this.$emit('AfterCreate');

                            })
                            .catch((data)=>{
                                console.log(data);
                                swal(
                                    'Ошибка!',
                                    'что то пошло не так',
                                    'warning'
                                )

                            })
                    }
                })
            },

        },
        mounted() {
            this.loadSlides();
            this.$on('AfterCreate', () => {
                this.loadSlides();
            })

        }
    }
</script>










