<style>

    .carousel-component {
        position: relative;
        overflow: hidden;
        width: 300px;
    }
    .carousel-item {
        width: 300px;
        height: 178px;
    }

    .carousel-page {
        visibility: hidden;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        transition: 0.5s;

    }



    .carousel-item img {
        width: 300px;
        height: 178px;
    }


    .carousel-page.active {
        visibility: visible;
        position: static;
    }

    .carousel-nav-prev {
        float: left;
    }
    .carousel-nav-next {
        float: right;
    }
    .carousel-nav-prev,
    .carousel-nav-next,
    .allNews{
        width: 140px;
        margin-top: 23px;
        cursor: pointer;
        color: #ffffff;
        background: #000000;
        border: none;
        outline: none;
        font-weight: 700;
        font-size: 14px;
        line-height: 24px;
        font-family: "PT Sans Narrow", "Arial", sans-serif;
        text-transform: uppercase;
        text-decoration: none;
        display: inline-block;
        vertical-align: top;
        text-align: center;
        padding: 10px 30px;
        height: 42px;
    }
    .carousel-nav-prev:hover,
    .carousel-nav-next:hover,
    .allNews:hover {
        background:#663d15;
    }

    .carousel-nav-prev {
        left: 5px;
    }

    .carousel-nav-next {
        right: 5px;
    }

</style>
<template>
    <main class="main">
        <div class="container">
            <div class="preview">
                <img id="logo" src="css/img/index-logo.png" alt="">
                <div class="worth" >

                    <div v-for="preview in previews.data" :key="preview.id">
                        <h3>{{preview.title}}</h3>
                        <span>{{preview.description}}</span>
                    </div>

                </div>
            </div>
            <div class="block top">
                <section class="left">
                    <div class="index-content-title">Новости</div>
                    <ul class="news-preview">
                        <li>
                            <p>Нам наконец завезли Ягермайстер! Теперь вы можете пропустить стаканчик во время стрижки</p>
                            <div>11 января</div>
                        </li>
                        <li>
                            <p>В нашей команде пополнение! Борис "Бритва" Стригунец, обладатель множества наград и титулов пополнил наши стройные ряды</p>
                            <div>18 января</div>
                        </li>
                    </ul>

                    <router-link to="/news" class="allNews">Все новости</router-link>
                    <img class="column-one" src="css/img/column.png" alt="">

                </section>
                <section class="right">
                    <div class="index-content-title">Фотогалерея</div>

                    <carousel-component>
                        <carousel-item v-for="slide in slides.data" :key="slide.id">
                            <img :src="getSrc(slide.image)" alt="">
                        </carousel-item>
                    </carousel-component>

                    <img class="column-two" src="css/img/column.png" alt="">
                </section>

            </div>
            <div class="block bottom">
                <section class="left">
                    <div class="index-content-title">Контактная информация</div>

                    <div>
                        <p>Барбершоп "бородинский"</p>
                        <p>Адрес: г.Санкт-Петербург, б.Конюшенная, д.19</p>
                        <p>Телефон: +7(495)666 02 66</p>
                    </div>
                    <div class="time">
                        <p>Врем работы:</p>
                        <p>пн-пт: с 10:00 до 22:00</p>
                        <p>сб-вс: с 10:00 до 19:00</p>
                    </div>
                    <div class="information-btn">
                        <button id="openMap" class="btn gallery-prev">Как проехать</button>
                        <button class="btn gallery-next">Обратная свзь</button>
                    </div>
                </section>
                <section class="right">
                    <div class="record">
                        <div class="index-content-title">Записаться</div>
                        <p>Укажите желаемую дату и время и мы свяжемся с Вами для подтверждения брони</p>
                        <form  class="appointment-form" >
                            <div>
                                <p>Дата</p>
                                <input type="text" name="date" value="" placeholder="Дата">
                            </div>
                            <div>
                                <p>Время</p>
                                <input type="text" name="time" value="" placeholder="Время">
                            </div>
                            <br>
                            <div>
                                <p>Ваше имя</p>
                                <input type="text" name="name" value="" placeholder="Ваше имя">
                            </div>
                            <div>
                                <p>Телоефон</p>
                                <input type="tel" name="tel" value="" placeholder="Телефон">
                            </div>
                            <br>
                            <button class="btn" name="submit">Отправить</button>
                        </form>
                    </div>
                </section>

            </div>


        </div>

    </main>
</template>

<script>
    export default {

        data() {
            return {
                current: 0,
                editmode:true,
                slides: {},
                previews: {},
            }
        },


        methods: {

            getSrc(img){
                let image = "/img/carousel/" + img;
                return image;
            },
            loadSlides(){
                axios.get('/api/carousel')
                    .then(({data}) =>
                        (this.slides = data));

            },
            loadPreviews(){
                axios.get('/api/preview')
                    .then(({data}) =>
                        (this.previews = data));

            },
        },

        mounted() {
            this.loadSlides();
            this.loadPreviews();
        }
    }
</script>
