<template>
    <div v-if="bloc">
        <section class="img-section">
            <div class="container">
                <div id="img-section-container" class="img-section-container" v-for="image in bloc.sketchImages" :key="bloc.fieldGroupName">
                    <div class="img-container grid-item">
                        <img :src="image.sketchImage.sourceUrl">
                    </div>
                </div>
            </div>
            <div class="spacer" style="clear: both;"></div>
        </section>
    </div>
</template>

<script>
    export default {
        props: [
            'bloc'
        ]
    }
</script>

<style lang="scss" scoped>
    .img-section{
        // background-color: $white;
        background-color: #fff;
    }
    .img-section-container{
        display: inline-block;
        width: 50%;
        float: left;
        &:nth-child(2){
            .img-container{
                max-width: 240px;
                margin: 0 auto;
            }
        }
        .img-container{
            width: 100%;
        }
        .phone-container{
            text-align: center;
            padding: 100px 0;
        }
    }

</style>