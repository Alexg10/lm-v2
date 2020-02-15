<template>
    <section v-if="bloc" class="bloc-after">
        <div class="container">
            <div class="after-bg">
                <img src="~/assets/images/block/ae_anim.svg" alt="">
            </div>
            
            <div class="bloc-after-top-left-container">
                <div id="animation"></div>
            </div>
            <div class="bloc-after-top-right-container">
                <div id="anim-result"></div>
            </div>
            <div class="bloc-after-top-middle-container">
                <div id="anim-htu"></div>
            </div>
            <div class="bloc-after-full-height-container" v-for="image in bloc.imagesFullHeight" v-bind:key>
                <img class="bloc-after-top-middle-img" :src="image.imageFullHeight.sourceUrl">
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
 .container{
        position: relative;
    }
    .bloc-after{
        position: relative;
        // margin-top: -130px;
        padding-top: 118px;
        padding-bottom: 125px;
        overflow: hidden;
        .after-bg{
            position: absolute;
            top: 300px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 0;
            width: 100%;
            img{
                width: 100%;
            }
        }
        .bloc-after-top-left-container,
        .bloc-after-top-right-container,
        .bloc-after-top-middle-container,
        .bloc-after-full-height-container{
            position: relative;;
            display: inline-block;
            z-index: 10;
        }
        .bloc-after-top-middle-container{
            display: block;
            text-align: center;
            margin-top: 136px;
            margin-bottom: 125px;
        }

        .bloc-after-top-left-container{
            position: relative;
            right: 115px;
            float: right;
            max-width: 311px;
        }
        .bloc-after-top-right-container{
            padding-top: 144px;
            position: relative;
            left: 130px;
            max-width: 400px;
        }
        #anim-htu{
            max-width: 580px;
            margin: 0 auto;
        }
        .bloc-after-full-height-container{
            width: 50%;
            float: left;
        }
        @media ( max-width : 780px ) {
            padding: 0 10px;
            .bloc-after-full-height-container{
                img{
                    width: 100%;
                }
            }

        }
    }

    @media ( max-width : 680px ) {
        .container{
            text-align: center;
        }
        .bloc-after-full-height-container{
            width: 100%;
        }
        .bloc-after{
            .container{
                text-align: center;
            }
            .bloc-after-top-left-container{
                float: none;
                right: auto;;
            }
            .bloc-after-top-right-container{
                left: 0;
            }
            .bloc-after-top-right-container{
                .anim-container {
                    display: flex;
                    max-width: 80%;
                    margin: 0 auto;
                    margin-top: 40px;
                }
            } 
            .bloc-after-top-middle-container{
                margin-top: 76px;
            }
            .bloc-after-full-height-container{
                width: 100%;
            }
        }
    }
</style>