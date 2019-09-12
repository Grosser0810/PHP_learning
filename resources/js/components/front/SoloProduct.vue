<template>
    <div class="solo-product">

    <main class="container"  v-for="product in products">
        <div class="shop-page-title">
            <h1>{{product.title}}</h1>
            <ul class="breadcrumbs">
                <li>
                    <a href="index.html">Главная</a>
                </li>
                <li>
                   <router-link to="/shop">Магазин</router-link>
                </li>
                <li class="current"  v-for="product in products">
                    {{product.title}}
                </li>
            </ul>
        </div>
        <div class="clearfix solo-flex">
            <section class="item-preview-left">
                <div  class="image-container-big">
                    <img :src="getSrc(product.image)"  :alt="product.title">
                </div>

            </section>
            <section class="item-preview-right">
                <div class="item-article">
                    <div class="item-article-flex">
                        <p>{{product.stock}}</p>
                        <span>Артикул: {{product.code}}</span>
                    </div>
                    <p class="description">{{product.description}}</p>
                    <div class="cost-good item-place">
                        <div class="price">{{product.price}} BYN</div>
                        <a href="#" class="btn-front">Купить</a>
                    </div>
                </div>
                <div class="item-contains">
                    <h2>В набор входят:</h2>
                    <ul class="custom-list-1 custom-list-description">
                        <li>Средство для умывания (50 мл)</li>
                        <li>Увлажняющий крем (50 мл)</li>
                        <li>Крем для бритья (50 мл)</li>
                        <li>Крем после бритья, шампунь (50 мл)</li>
                        <li>Удобная кожаная косметичка</li>

                    </ul>
                </div>
            </section>
        </div>
    </main>
</div>
</template>



<script>
    export default {
        data () {
            return {
                id: this.$route.params['id'],
                products: {},
            }
        },

        methods: {
            loadProduct(){
                axios.get('/api/loadSoloProduct?id=' + this.id)
                    .then((data) =>
                        (this.products = data.data));

            },
            getSrc(img){
                let image = "/img/product/" + img;
                return image;
            },
        },

        mounted() {
            this.loadProduct();
        }
    }
</script>