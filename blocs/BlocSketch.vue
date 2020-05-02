<template>
    <div v-if="bloc" v-bind:style='{backgroundColor: bloc.color}'>
        <section class="img-section">
            <div class="container">
                <div id="img-section-container" class="img-section-container" v-for="(image, index) in bloc.sketchImages" :key="bloc.id">
                    <div class="img-container grid-item">
                        <div v-if="bloc.sketchMobileVideo && index == 1" class="mobile-container">
                            <img class="mobile-svg" src="~/assets/images/block/mobile.svg" alt="">
                            <video class="sketch-mobile-preview-video video" loop muted autoplay>
                                <source :src="bloc.sketchMobileVideo" type="video/mp4">
                            </video>
                        </div>
                        <div v-else>
                            <img  :src="image.sketchImage.sourceUrl">
                        </div>
                    </div>
                </div>
            </div>
            <div class="spacer" style="clear: both;"></div>
        </section>
    </div>
</template>

<script>
    import gsap from 'gsap'

    export default {
        data(){
            return{
                timelines: {},
                scenes: [],
                durationPara: 0
            }
        },
        props: [
            'bloc'
        ],
        methods: {
            createTimelines(){
                const blocSketchTimeline = new TimelineMax({ paused: false});
                blocSketchTimeline.fromTo(".img-section .container", 2, {y: 40, opacity: 0}, {y: 0, opacity: 1, ease: Power4.easeInOut, overwrite: false});                

                // if(!this.$device.mobile){
                // }

                const blocSketchParallax = new TimelineMax({ paused: false});
                const img1 = document.querySelector(".img-section-container:nth-child(1) .img-container div");
                const img2 = document.querySelector(".img-section-container:nth-child(2) .img-container div");
                const img3 = document.querySelector(".img-section-container:nth-child(3) .img-container div");
                blocSketchParallax
                    .fromTo(img1, 1, {y: 0},{y: 300, overwrite: false},"start")
                    .fromTo(img2, 1, {y: 0},{y: -80, overwrite: false}, "start")
                    .fromTo(img3, 1, {y: 0},{y: -100, overwrite: false}, "start");

                this.timelines = {
                    sketch        : blocSketchTimeline,
                    sketchParallax: blocSketchParallax
                }
            },
            createScenes(){
                console.log("durationP");
                const durationP = document.querySelector(".img-section").offsetHeight*1.5;
                console.log(durationP);
                this.scenes = [
                    this.$scrollmagic.scene({
                        triggerElement: ".img-section",
                        triggerHook: 0.65,
                        offset: -50
                    })
                    .setTween(this.timelines.sketch)
                    .reverse(false),
                    this.$scrollmagic.scene({
                        triggerElement: ".img-section",
                        triggerHook: 0.65,
                        offset: -150,
                        duration: durationP
                    })
                    .setTween(this.timelines.sketchParallax)
                ]
            }
        },
        mounted() {
            this.durationPara = document.querySelector(".img-section").offsetHeight*1.5;
            console.log(this.durationPara);
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
    .img-section{
        // background-color: $white;
        background-color: #fff;
    }
    .container{
        max-width: 1320px;
        @media only screen and ( max-width : 680px ) {
            display: flex;
            flex-direction: column;
        }
    }
    .sketch-mobile-preview-video{
        width: 100%;
    }
    .img-section-container{
        display: inline-block;
        width: 50%;
        padding: 0 45px;
        float: left;
        @media only screen and ( max-width : 680px ) {
            padding: 0 25px;
        }
        @media only screen and ( max-width : 680px ) {
            width: 100%;
            padding: 0;
            order: 2;
        }
        &:nth-child(1){
            .img-container{
                img{
                    margin-bottom: 300px;
                }
            }
        }

        &:nth-child(2){
            margin-bottom: 120px;
            margin-top: -120px;
            @media only screen and ( max-width : 680px ) {
                margin-top: 0;
                margin-bottom: 60px;
                order: 1;
            }
            .img-container{
                max-width: 310px;
                margin: 0 auto;
            }
        }
        .img-container{
            width: 100%;
            img{
                width: 100%;
            }
        }
        .phone-container{
            text-align: center;
            padding: 100px 0;
        }
    }
    .mobile-container{
        position: relative;
        &:before{
            content: '';
            position: absolute;
            left: 50%;
            top: 31px;
            transform: translateX(-50%);
            height: 21px;
            width: 94px;
            border-radius: 17px;
            background-color: black;
            z-index: 9;
        }
        .mobile-svg{
            position: relative;
        }
        .video{
            width: 100%;
            position: absolute;
            left: 50%;
            top: 42px;
            width: 72%;
            transform: translateX(-50%);
            border-radius: 17px;
        }
    }

</style>