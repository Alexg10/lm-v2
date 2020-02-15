<template>
    <section v-if="bloc" class="img-4-section">
        <div class="container">
            <div class="img-4-section-container" >
                <div class="img-4-container grid-item" v-for="four_image in bloc.blocFourSectionImg" v-bind:key>
                    <img class="img-4" :src="four_image.image.sourceUrl" :alt="four_image.image.title">
                </div>
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
    .img-4-section{
        padding: 90px 0 110px;
        .img-4-section-container{
            display: flex;
            .img-4-container{
                flex: 1;
                display: flex;
                justify-content: center;
                overflow: hidden;
            }
        }
        @media only screen and ( max-width : 768px ) {
            .img-4-section-container{
                display: block;
                overflow: hidden;
                .img-4-container{
                    width: 50%;
                    float: left;
                }
            }
        }
        @media only screen and ( max-width : 680px ) {
            .img-4-section-container{
                flex-wrap: wrap;
                .img-4-container{
                    flex: 50%;
                    margin-bottom: 30px;
                    min-height: 130px;
                    img{
                        width: 65%;
                    }
                }
            }
        }
    }
</style>