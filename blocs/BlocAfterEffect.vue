<template>
    <section v-if="bloc" class="bloc-after">
        <div class="container">
            <div class="after-bg">
                <img src="~/assets/images/block/ae_anim.svg" alt="">
            </div>
            <slick-slide ref="slickAnim" :options="slickOptions" class="anim-slider" >
                <div class="bloc-after-top-left-container">
                    <div id="animation"></div>
                </div>
                <div class="bloc-after-top-right-container">
                    <div id="anim-result"></div>
                </div>
                <div class="bloc-after-top-middle-container">
                    <div id="anim-htu"></div>
                </div>

            </slick-slide>
            <div class="bloc-after-full-height-container" v-for="image in bloc.imagesFullHeight" v-bind:key>
                <img class="bloc-after-top-middle-img" :src="image.imageFullHeight.sourceUrl">
            </div>
        </div>
    </section>
</template>

<script>
    import lottie from 'lottie-web'

    export default {
        data(){
            return{
                timelines: {},
                scenes: [],
                slickOptions: {
                    speed     : 1600,
                    infinite  : true,
                    centerMode: false,
                    dots      : true,
                    arrows    : false,
                    cssEase   : 'cubic-bezier(.19,.77,.2,1)',
                    responsive: [
                        {
                            breakpoint: 9999,
                            settings: "unslick"
                        },
                        {
                            breakpoint: 860,
                            settings: {
                                infinite: true,
                            }
                        }
                    ]
                }
            }
        },
        props: [
            'bloc'
        ],
            methods: {
            createTimelines(){
                // blocStep timeline
                const afterParallaxTimeline = new TimelineMax({ paused: false});
                const imgH1 = document.querySelector(".bloc-after-full-height-container");
                const imgH2 = document.querySelector(".bloc-after-full-height-container:last-of-type");

                afterParallaxTimeline
                    .fromTo(imgH1, 1, {y: 0},{y: 100, overwrite: false}, "start")
                    .fromTo(imgH2, 1, {y: 0},{y: -50, overwrite: false}, "start");  

                this.timelines = {
                    afterParallax: afterParallaxTimeline
                }
            },
            createScenes(){
                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: ".bloc-after-full-height-container:last-of-type",
                        triggerHook: 0.75,
                        offset: 100,
                        duration: window.innerHeight*2
                    })
                    .setTween(this.timelines.afterParallax)
                ]
            }
        },
        mounted(){
            const vm = this;

            if(!this.$device.mobile){
                // Create timelines and scenes
                vm.createTimelines();
                vm.createScenes();

                // Add scenes to controller
                vm.$scrollmagic.addScene(vm.scenes);
            }
            
            lottie.loadAnimation({
                container: document.getElementById('animation'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "/images/anim_img/anim_intro.json"
            });

            lottie.loadAnimation({
                container: document.getElementById('anim-htu'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "/images/anim_img/anim-htu.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('anim-result'),
                renderer: 'svg',
                loop: true,
                autoplay: true,
                path: "/images/anim_img/anim-result.json"
            });
        },
        destroyed(){
            const vm = this;

            if(!this.$device.mobile){
                vm.$scrollmagic.removeScene(vm.scenes);

            }
        }
    }
</script>

<style lang="scss" scoped>
    .container{
        position: relative;
    }
    .bloc-after{
        position: relative;
        // margin-top: -130px;
        background-color: #F7F6F5;
        padding-top: 95px;
        padding-bottom: 125px;
        overflow: hidden;
        .after-bg{
            position: absolute;
            top: 250px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 0;
            width: 100%;
            @media ( max-width : 680px ) {
                top: 100px;
            }

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
            @media ( max-width : 780px ) {
                max-width: 80%;
                right: auto;
            }

        }
        .bloc-after-top-right-container{
            padding-top: 144px;
            position: relative;
            left: 130px;
            max-width: 400px;
            @media ( max-width : 780px ) {
                max-width: 80%;
                left: auto;
                right: auto;
            }
        }
        #anim-htu{
            max-width: 580px;
            margin: 0 auto;
        }
        .bloc-after-full-height-container{
            width: 50%;
            float: left;
            text-align: center;
            img{
                width: 100%;
                max-width: 500px;
            }
        }
        @media ( max-width : 780px ) {
            padding: 0 10px;
            padding-top: 100px;
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
            padding-top: 50px;
            .container{
                text-align: center;
            }
            .bloc-after-top-left-container{
                float: none;
                right: auto;
                #animation{
                    margin: 0 auto;
                    max-width: 220px;
                }
            }

            .bloc-after-top-right-container{
                left: 0;
                padding-top: 64px;
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
                margin-top: 0;
            }
            .bloc-after-full-height-container{
                width: 100%;
                img{
                    width: 100%;
                }
            }
        }
    }
</style>