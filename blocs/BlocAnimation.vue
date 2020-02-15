<template>
    <section v-if="bloc" class="bloc-animation">
        <div class="container">
            <div class="bloc-animation-desktop-container">
                <img class="bloc-animation-desktop-img" :src="bloc.imageDesktop.sourceUrl">
            </div>
            <div class="anim-container">
                <div id="animation-hand" class="hand-anim"></div>
                <div id="animation-smart" class="hand-anim"></div>
                <div id="animation-accessibility" class="hand-anim"></div>
                <div id="animation-creativ" class="hand-anim"></div>
            </div>
            <div class="bloc-animation-mobile-container">
                <img class="bloc-animation-mobile-img" :src="bloc.imageMobile.sourceUrl">
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
    .bloc-animation{
        // background: $white;
        background-color: #fff;
        position: relative;
        .container{
            width: 100%;
        }
        .bloc-animation-desktop-container{
            text-align: right;
            // overflow: hidden;
            .bloc-animation-desktop-img{
                width: 100%;
                max-width: 1050px;
            }
        }
        .bloc-animation-mobile-container{
            position: relative;
            display: inline-block;
            margin-top: -153px;
        }
        .anim-container{
            display: flex;
            width: 50%;
            position: relative;
            left: 35%;
            top: 20px;
            .hand-anim{
                flex: 1;
                padding: 0 10px;
            }
            #animation-accessibility{
                max-width: 90px;
            }
            #animation-smart{
                max-width: 140px;
            }
            #animation-creativ{
                max-width: 120px;
            }
        }
        @media ( max-width : 780px ) {
            .bloc-animation-mobile-container{
                margin-top: -83px;
                left: 20px;
            }
            .anim-container{
                .hand-anim{
                    flex: 1;
                    padding: 0 10px;
                }
                #animation-accessibility{
                    max-width: 70px;
                }
                #animation-smart{
                    max-width: 90px;
                }
                #animation-creativ{
                    max-width: 90px;
                }
            }
        }
        @media ( max-width : 680px ) {
            .bloc-animation-mobile-container{
                width: 40%;
                margin-top: 57px;
                img{
                    width: 100%;
                }
            }
            .anim-container{
                display: flex;
                width: 50%;
                position: absolute;
                left: 50%;
                top: 290px;
                right: 50px;
                flex-wrap: wrap;
                .hand-anim{
                    width: 50%;
                    flex: initial;
                }
            }
        }
    }
</style>