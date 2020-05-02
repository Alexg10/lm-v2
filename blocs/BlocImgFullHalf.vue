<template>
    <section v-if="bloc" class="img-full-half-section">
        <div class="img-full-half-section-container" >
            <div class="img-full-half-container" v-for="image in bloc.blocImgFullHalfImages" v-bind:key>
                <img class="img-full-half-container-img" :src="image.blocImgFullHalfImage.sourceUrl" alt="">
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
    .img-full-half-section{
        .img-full-half-section-container{
            display: flex;
            flex-wrap: wrap;
            .img-full-half-container{
                display: flex;
                justify-content: center;
                width: 50%;
                overflow: hidden;
                @media only screen and ( max-width : 780px ) {
                    display: block;
                }
                @media only screen and ( max-width : 680px ) {
                    width: 100%;
                }
                img{
                    width: 100%;
                    transform: scale(1.1);
                }
            }
        }
    }
</style>