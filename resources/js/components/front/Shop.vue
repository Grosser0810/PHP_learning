<template>
<div class="shop">
    <div class="container">

    <div class="shop-page-title">
        <h1>Cредства для ухода</h1>
        <ul class="breadcrumbs">
            <li>
                <router-link to="/" class="nav-link">Главная</router-link>
            </li>
            <li>
                <router-link to="/shop" class="nav-link">Магазин</router-link>
            </li>
            <li v-for="group in groups" class="current">
                {{group.group}}
            </li>
        </ul>
    </div>




    <div class="shop-content clearfix">

            <input type="checkbox" id="hmt" class="hidden-menu-ticker">
        <label class="btn-menu" for="hmt">
            <i class="fas fa-angle-double-right fa-2x"></i>
            <i class="fas fa-angle-double-left fa-2x"></i>
        </label>
            <form @submit.prevent="filterProduct()" class="sellers-column">
            <h2>Производители:</h2>

            <div class="shop-selector" >
                <ul class="producer-type">

                    <li v-for="manufacturer in manufacturers" class="brand item-1">
                        <label class="shop-checkbox">
                            <input v-model="manufacturer_id" class="check" type="checkbox" name="brand" :value="manufacturer.id">
                            <span class="checkbox-indicator"></span>
                            {{manufacturer.manufacturer}}
                        </label>
                    </li>

                </ul>
                <h2>Группы товаров:</h2>
                <ul class="product-type">
                    <li v-for="group in groups" class="product type-1">
                        <label class="shop-radio">
                            <input v-model="group_id" type="radio" name="radio" :value="group.id">
                            <span class="radio-indicator"></span>{{group.group}}</label>
                    </li>

                </ul>
                <button type="submit" class="btn-front sort-product" href="#">Показать</button>
        </div>
        </form>


        <div class="catalog">
            <div v-for="product in products.data" :key="product.id" class="list-of-goods">
                <div class="image-good">
                    <router-link to="/shop/solo">
                        <img :src="getSrc(product.image)" width="220" height="165" :alt="product.title">
                    </router-link>
                </div>
                <div class="description-good">
                    <router-link to="/products/" href="item.html">{{product.title}}</router-link>
                </div>
                <div class="cost-good">
                    <div class="price"><p>{{product.price}}</p></div>
                    <a href="#" class="btn-front">Купить</a>
                </div>
            </div>

        </div>

    </div>
        <div class="card-footer pagination">
            <pagination :data="products" @pagination-change-page="getResults"></pagination>
        </div>
    </div>


</div>
</template>

<!--<style>
    .pagination {
        margin-left:/*185px*/ 14.5%;
        display: flex;
        list-style: none;
        padding:43px 0 50px 0;
    }
    .pagination li {
        width: 43px;
        height: 43px;
        background: black;
        margin: 7px;

    }

    .pagination li a {
        display: block;
        text-decoration:none;
        color: #fff;
        width: 43px;
        height: 43px;
        padding: 11px 0 0 17px;
    }
    .pagination .active {
        background: #fff;
    }

    .pagination .active a {
        color: black;
    }

    .pagination .sr-only {
        opacity: 0;
    }

    /*.shop {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'PT Sans Narrow', sans-serif;
        background: url("/css/img/texture-main.png");

    }*/

    .shop-page-title h1 {
        margin:0 0 20px 0;
        padding: 60px 0 0 0;
        font-size: 30px;
        line-height: 42px;
        text-transform: uppercase;
    }


   /* Хлебные крошки*/
    .breadcrumbs {
        margin: 0;
        padding: 0;
        list-style: none;
        text-transform: uppercase;
    }

    .breadcrumbs li {
        position: relative;
        display: inline;
        padding-right: 40px;
    }

    .breadcrumbs li::after {
        position: absolute;
        content: "";
        width: 8px;
        top: 5px;
        right: 17px;
        height: 8px;
        background-color: #000000;
        transform: rotate(45deg);
    }

    .breadcrumbs .current::after {
        display: none;
    }

    .breadcrumbs a {
        color: #000000;
        text-decoration: none;
    }

    .breadcrumbs a:hover {
        text-decoration: underline;
    }

    .breadcrumbs .current {
        color: #aba9a7;
    }

    .breadcrumbs {
        margin-bottom: 0px;
        padding: 0;
        list-style: none;
    }
    /*///////////////////////////*/



    /*     &#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;сайдбар&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;&#45;*/

    .shop-content {
        padding: 60px 0 0 0;
        display: flex;
        justify-content: space-between;

    }

    .sellers-column {
        text-transform: uppercase;

    }

    .producer-type {

        margin:0;
        padding:35px 0 59px 0;
        list-style: none;
    }

    .producer-type li {
        margin-bottom: 14px;


    }


    /* чекбокс магазина */
    .shop-checkbox {
        position: relative;
        padding-left: 30px;
        cursor: pointer;
        font-size: 14px;
    }

    .shop-checkbox:hover {
        color: #663d15;
    }

    .shop-selector input[type="checkbox"] {
        display: none;
    }

    .shop-selector input[type="checkbox"] + .checkbox-indicator {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 20px;
        height: 20px;
        border: 2px solid #000000;
    }

    .shop-selector input[type="checkbox"]:checked + .checkbox-indicator::before,
    .shop-selector input[type="checkbox"]:checked + .checkbox-indicator::after {
        content: "";
        position: absolute;
        top: 8px;
        left: 1px;
        width: 15px;
        height: 2px;
        background-color: #000000;
    }

    .checkbox-indicator::before {
        transform: rotate(45deg);
    }

    .checkbox-indicator::after {
        transform: rotate(-45deg);
    }

    /*//////////////////////////*/



    /*радио-кнопки */

    .product-type {
        margin: 0;
        /*margin-bottom: 48px;*/
        padding:35px 0 59px 0;;
        list-style: none;
    }

    .product-type li {
        margin-bottom: 14px;
        margin-left: 11px;
        font-size: 14px;
    }


    .shop-radio{
        position: relative;
        padding-left: 30px;
        cursor: pointer;
    }

    .shop-radio:hover {
        color: #663d15;
    }

    .shop-selector input[type="radio"] {
        display: none;
    }

    .shop-selector input[type="radio"] + .radio-indicator {
        position: absolute;
        top: -3px;
        left: -10px;
        width: 23px;
        height: 22px;
        background: url("/css/img/second-sprite.png") 0 -410px no-repeat;
    }

    .shop-selector input[type="radio"]:checked + .radio-indicator::before {
        position: absolute;
        width: 23px;
        height: 22px;
        background: url("/css/img/second-sprite.png") 0 -340px no-repeat;
        content: "";
    }
    .btn-front {
        cursor: pointer;
        color: #ffffff;
        background: #000000;
        border: none;
        outline: none;
        font-weight: 700;
        font-size: 14px;
        margin-right: 16px;
        line-height: 24px;
        font-family: "PT Sans Narrow", "Arial", sans-serif;
        text-transform: uppercase;
        text-decoration: none;
        display: inline-block;
        vertical-align: top;
        text-align: center;
        padding: 10px 5px;
        height: 42px;
        width: 78px;
    }


    .btn-front:hover {
        background:#663d15;
    }
    /*//////////////////////////////////*/

   /* какталог*/

    .catalog {
        margin-left: 50px;
        width: 700px;
        height: 592px;
        display: flex;
        justify-content:space-between;
        flex-wrap: wrap;
        align-content: space-between;
    }

    .list-of-goods {
        background: #fff;
        width: 220px;
        height: 286px;
        box-shadow: 0 0 15px 0px rgba(0, 0, 0, 0.2);
    }

    .image-good {

        width: 100%;
        height: 165px;

    }

    .description-good {
        height: 60px;
        margin: 0 auto;
        padding: 10px 16px;
    }

    .description-good a {
        text-decoration: none;
        color: #000000;
    }

    .cost-good {
        display: flex;
    }

    .price {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left:16px;
        width: 110px;
        height: 42px;
        background: #e5e5e5;
        text-transform: uppercase;
    }

</style>-->

<script>
    export default {
        data() {
            return {
                group_id: '',
                manufacturer_id: [],
                products: {},
                groups: [],
                manufacturers: [],

            }
        },

        methods: {

            filterProduct(){
                let queryGroup = this.group_id;
                let queryManufacturer = this.manufacturer_id;
                axios.get('/api/filterProduct?g=' +queryGroup + '&m=' +queryManufacturer)
                    .then((data)=>{
                        this.products = data.data;
                    })
                    .catch(()=>{

                    })

            },

            //-------------------------------------------------------

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



        },

        mounted() {

            this.loadGroups();
            this.loadManufacturers();
            this.loadProducts();

        }

    }
</script>