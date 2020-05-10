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
                <div v-if="bloc.videoMobile" class="bloc-animation-mobile-img  mobile-container">
                    <img class="mobile-svg" src="~/assets/images/block/mobile.svg" alt="">
                    <video class="video" loop muted autoplay>
                        <source :src="bloc.videoMobile" type="video/mp4">
                    </video>
                </div>
                <img v-else class="bloc-animation-mobile-img" :src="bloc.imageMobile.sourceUrl">
            </div>
        </div>
    </section>
</template>

<script>
    import gsap from 'gsap'
    import lottie from 'lottie-web'

    export default {
        data(){
            return{
                timelines: {},
                scenes: []
            }
        },
        props: [
            'bloc'
        ],
        methods: {
            createTimelines(){
                const animationTimeline         = new TimelineMax({ paused: false});
                const animationParallaxTimeline = new TimelineMax({ paused: false});
                const animImg                   = document.getElementsByClassName("bloc-animation-desktop-img");
                const animImgMob                = document.getElementsByClassName("bloc-animation-mobile-img");
                const video                     = document.getElementsByClassName("video");


                animationTimeline
                    .fromTo(animImg, 2, {yPercent: 10, opacity:0},{yPercent: 0, opacity:1, ease: Power4.easeInOut, overwrite: false},  "start")
                    .fromTo(animImgMob, 2, {yPercent: 50, opacity:0},{yPercent: 0, opacity:1, ease: Power4.easeInOut, overwrite: false},  "start=+0.5")
                    .staggerFromTo('.hand-anim', 2, {opacity:0},{opacity: 1, ease: Power4.easeInOut, stagger:0.3},  "start+=");  

                animationParallaxTimeline.fromTo(animImgMob, 2, {y: 500},{y: -30, overwrite: false}, "start");                

                this.timelines = {
                    animation: animationTimeline,
                    animationParallax: animationParallaxTimeline
                }
            },
            createScenes(){
                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: this.$el,
                        triggerHook: 0.7,
                        offset: -200
                    })
                    .reverse(false)
                    .setTween(this.timelines.animation),
                    this.$scrollmagic.scene({
                        triggerElement: this.$el,
                        triggerHook: 0.65,
                        offset: -80,
                        duration: window.innerHeight*2
                    })
                    .reverse(true)
                    .setTween(this.timelines.animationParallax),
                ]
            }
        },
        mounted(){
            lottie.loadAnimation({
                container: document.getElementById('animation-hand'),
                renderer : 'svg',
                loop     : true,
                autoplay : true,
                path     : "/images/anim_img/anim-hand-human.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('animation-accessibility'),
                renderer : 'svg',
                loop     : true,
                autoplay : true,
                path     : "/images/anim_img/anim-hand-accessible.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('animation-smart'),
                renderer : 'svg',
                loop     : true,
                autoplay : true,
                path     : "/images/anim_img/anim-hand-smart.json"
            });
            lottie.loadAnimation({
                container: document.getElementById('animation-creativ'),
                renderer : 'svg',
                loop     : true,
                autoplay : true,
                path     : "/images/anim_img/anim-hand-creativ.json"
            });

            // Create timelines and scenes
            this.createTimelines();
            this.createScenes();

            // Add scenes to controller
            this.$scrollmagic.addScene(this.scenes);
        },
        destroyed() {
            this.$scrollmagic.removeScene(this.scenes);
        }
    }
</script>

<style lang="scss" scoped>
    .bloc-animation{
        // background: $white;
        background-color: #fff;
        position: relative;
        @media ( max-width : 680px ) {
            margin-bottom: 200px;
        }
        .container{
            width: 100%;
        }
        .bloc-animation-desktop-container{
            text-align: right;
            margin-bottom: 70px;
            // overflow: hidden;
            .bloc-animation-desktop-img{
                width: 100%;
                max-width: 1050px;
            }
        }
        .bloc-animation-mobile-container{
            position: relative;
            display: inline-block;
            position: absolute;
            max-width: 250px;
            bottom: 0;
            z-index: 9;
            // margin-top: -153px;
            img{
                width: 100%;
            }
            .mobile-container{
                position: relative;
                &:before{
                    content: '';
                    position: absolute;
                    left: 50%;
                    top: 27px;
                    transform: translateX(-50%);
                    height: 21px;
                    width: 94px;
                    border-radius: 17px;
                    background-color: black;
                    z-index: 9;
                    @media ( max-width : 680px ) {
                        top: 15px;
                        height: 8px;
                        width: 54px;
                    }
                }
                .mobile-svg{
                    position: relative;
                }
                .video{
                    width: 100%;
                    position: absolute;
                    left: 50%;
                    top: 34px;
                    width: 72%;
                    transform: translateX(-50%);
                    border-radius: 17px;
                    @media ( max-width : 680px ) {
                        top: 20px;
                    }

                }
            }
        }
        .anim-container{
            display: flex;
            width: 60%;
            position: relative;
            left: 28%;
            top: -63px;
            justify-content: space-between;
            .hand-anim{
                flex: 1;
                padding: 0 10px;
                svg{
                    width: 70%!important;
                }
            }
            #animation-hand{
                max-width: 130px;
            }
            #animation-accessibility{
                max-width: 60px;
            }
            #animation-smart{
                max-width: 90px;
            }
            #animation-creativ{
                max-width: 80px;
            }
        }
        @media ( max-width : 780px ) {
            .bloc-animation-mobile-container{
                margin-top: -83px;
                left: 20px;
            }
            .anim-container{
                width: 55%;
                left: 38%;
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
                bottom: -270px;
                img{
                    width: 100%;
                }
            }
            .anim-container{
                display: flex;
                width: 45%;
                position: absolute;
                left: 50%;
                top: 240px;
                right: 50px;
                flex-wrap: wrap;
                justify-content: space-evenly;
                .hand-anim{
                    width: 50%;
                    flex: initial;
                }
                #animation-hand{
                    max-width: 130px;
                }
                #animation-accessibility{
                    max-width: 50px;
                }
                #animation-smart{
                    max-width: 70px;
                }
                #animation-creativ{
                    max-width: 63px;
                }
            }
        }
    }
</style>