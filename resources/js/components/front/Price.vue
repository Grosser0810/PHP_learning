<template>
    <div class="price-page">
        <main class="container">
        <div class="inner-page-title">
            <h1>Прайс-лист</h1>
            <ul class="breadcrumbs">
                <li>
                    <router-link to="/">Главная</router-link>
                </li>
                <li class="current">
                    Прайс-лист
                </li>
            </ul>
        </div>
        <div class="inner-content">
            <div class="big-heading">
                <h2>Истинно мужская классика</h2>
            </div>
            <div class="inner-columns-flex clearfix ">
                <div class="inner-column-left">
                    <h2>Мы используем только лучшие средства:</h2>
                    <ul class="custom-list-1">
                        <li v-for="manufacturer in manufacturers.data" :key="manufacturer.id">{{ manufacturer.manufacturer }}</li>
                    </ul>
                </div>
                <div class="inner-column-right">
                    <h2>Цены на услуги наших мастеров:</h2>
                    <table class="prices-table">
                        <tr v-for="price in prices.data" :key="price.id">
                            <td>{{price.title}} BYN</td>
                            <td>{{price.cost}} BYN</td>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="inner-columns clearfix">
                <h2>Несколько слов о нас:</h2>
                <div class="inner-columns-flex">
                    <div class="inner-column-left">
                        <p class="short-text">Наша парихмахерская занимается исключительно мужскими стрижками. Стрижка каждого клиента для нас - это уникальная и продуманная до мелочей работа. Мы не работаем на количество, мы делаем качество.</p>
                    </div>
                    <div class="inner-column-right">
                        <p class="short-text">Наша мастерская расположена в центре города, поэтому сделать стильную стрижку можно в любое время, даже в обеденный перерыв. Здесь вы можете погрузиться в удобную для вас атмосферу, чувствовать себя комфортно и свободно!</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                prices: {},
                manufacturers: {},
                }
        },

        methods: {

            loadPrices(){
                axios.get('/api/price')
                    .then(({data}) =>
                        (this.prices = data));
            },
            loadManufacturers(){
                axios.get('/api/manufacturer')
                    .then(({data}) =>
                        (this.manufacturers = data));
            },

        },
        mounted() {
            this.loadPrices();
            this.loadManufacturers();
        }
    }
</script>
