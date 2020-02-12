<template>
    <section v-if="bloc" class="img-full-center-section">
        <div class="container">
            <div class="img-full-center-section-container">
                <img :src="bloc.blocImgFullCenterImg.sourceUrl" alt="">
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: [
            'bloc'
        ]
    }
</script>

<style lang="scss" scoped>
    .img-full-center-section{
        position: relative;
        .img-full-center-section-container{
            position: relative;
            display: flex;
            justify-content: center;
            z-index: 9;
            img{
                width: 100%;
            }
        }
    }
</style>